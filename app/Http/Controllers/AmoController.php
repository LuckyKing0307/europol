<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Collections\NotesCollection;
use AmoCRM\Filters\ContactsFilter;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\NoteType\CommonNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\OAuth2\Client\Token\AccessToken;

class AmoController extends Controller
{
    protected AmoCRMApiClient $client;

    public function __construct()
    {
        $this->client = new AmoCRMApiClient(
            config('services.amocrm.client_id'),        // можно любой, если не используется
            config('services.amocrm.client_secret'),    // можно любой
            config('services.amocrm.redirect_uri')      // можно любой
        );

        $token = new AccessToken([
            'access_token' => config('services.amocrm.access_token'),
            'expires' => time() + 3600 * 24 * 365, // фиктивный срок, например 1 год
            'refresh_token' => '',                       // не нужен
            'baseDomain' => config('services.amocrm.base_domain'),
        ]);

        $this->client->setAccountBaseDomain(config('services.amocrm.base_domain'));
        $this->client->setAccessToken($token);
    }

    public function createLead(string $name, int $price = 0): void
    {
        $lead = new LeadModel();
        $lead->setName($name)->setPrice($price)->setPipelineId(9736994)->setStatusId(77582534);
        $leads = new LeadsCollection();
        $leads->add($lead);

        $this->client->leads()->add($leads);
    }

    public function createLeadMessage(string $name, $contact, $text): void
    {
        $lead = new LeadModel();
        $lead->setName($name)->setPrice(0)->setPipelineId(9736994);
        $lead->setContacts((new ContactsCollection())->add($contact));

        $leads = new LeadsCollection();
        $leads->add($lead);

        $leads = $this->client->leads()->add($leads);
        $lead = $leads->first();
        $this->addUserMessageToLead($lead, $text);
    }
    public function addUserMessageToLead(LeadModel $lead, string $text): void
    {
        $note = new CommonNote();
        $note->setEntityId($lead->getId())
            ->setText($text);

        $notes = new NotesCollection();
        $notes->add($note);

        $this->client->notes('leads')->add($notes);
    }
    public function addContact($name, $number, $text)
    {

        $check = $this->findContactByPhone($number);
        if ($check) {
            $createdContact = $check;
        } else {
            $contact = new ContactModel();
            $contact->setName($name);

            $customFields = new CustomFieldsValuesCollection();
            $phoneField = new MultitextCustomFieldValuesModel();
            $phoneField->setFieldId(1865207); // твой field_id

            $phoneValues = new MultitextCustomFieldValueCollection();
            $phoneValues->add(
                (new MultitextCustomFieldValueModel())
                    ->setValue($number)
                    ->setEnumId(1782623) // твой enum_id
            );

            $phoneField->setValues($phoneValues);
            $customFields->add($phoneField);
            $contact->setCustomFieldsValues($customFields);

            $contacts = new ContactsCollection();
            $contacts->add($contact);
            $contacts = $this->client->contacts()->add($contacts);
            $createdContact = $contacts->first();
        }
        $this->createLeadMessage($name, $createdContact, $text);
    }
    public function findContactByPhone(string $phone): ?ContactModel
    {
        $filter = new ContactsFilter();
        $filter->setQuery($phone); // поиск похожих

        $contacts = $this->client->contacts()->get($filter);

        foreach ($contacts as $contact) {
            $fields = $contact->getCustomFieldsValues();
            if (!$fields) continue;

            $phoneFields = $fields->getBy('fieldId', 1865207); // твой field_id

            if ($phoneFields) {
                foreach ($phoneFields->getValues() as $fieldValue) {
                    if ($fieldValue->getValue() === $phone) {
                        return $contact;
                    }
                }
            }
        }

        return null; // не найден
    }
    public function pipes()
    {
        //1782623
        $customFields = $this->client->customFields('contacts')->get();
        foreach ($customFields as $field) {
            if ($field->getName() === 'Телефон') { // 👈 именно по имени поля
                echo "📞 Field ID: {$field->getId()}" . PHP_EOL;

                foreach ($field->getEnums() ?? [] as $enum) {
                    echo "- Enum ID: {$enum->getId()}, Code: {$enum->getCode()}" . PHP_EOL;
                }
            }
        }

    }

}
