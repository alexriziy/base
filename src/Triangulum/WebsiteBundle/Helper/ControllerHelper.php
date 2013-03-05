<?php
namespace Triangulum\WebsiteBundle\Helper;

use Symfony\Component\Translation\TranslatorInterface;
use Triangulum\WebsiteBundle\Model\UserQuery;

class ControllerHelper
{
    /** @var array $responseData */
    protected $responseData = array('error' => '', 'success' => '');

    /** @var array $config */
    protected $config;

    /** @var array $translator */
    protected $translator;

    /** @var Swift_Mailer $mailer */
    protected $mailer;

    /** @var object $templating */
    protected $templating;

    /** @var object */
    protected $security;

    /**
     * Constructor.
     *
     * @param array $config
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     * @param Swift_Mailer $mailer
     * @param object $templating
     * @param object $security
     *
     * @return \Triangulum\WebsiteBundle\Helper\ControllerHelper
     */
    public function __construct($config, TranslatorInterface $translator, $mailer, $templating, $security)
    {
        $this->config = $config;
        $this->translator = $translator;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->security = $security;
    }

    /**
     * Send email
     *
     * @param string $setFrom
     * @param mixed array|string $setTo
     * @param string $subject
     * @param string $templateView
     * @param array $templateParameters
     *
     * @return int
     */
    public function sendEmail($setFrom, $setTo, $subject, $templateView, $templateParameters)
    {
        $mailBody = $this->templating->render($templateView, $templateParameters);
        $message = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject($subject)
            ->setFrom($setFrom)
            ->setTo($setTo)
            ->setBody($mailBody);

        return $this->mailer->send($message);
    }

    /**
     * Create folder
     *
     * @param string $dirPath
     *
     * @return boolean
     */
    public static function createFolder($dirPath)
    {
        if (file_exists($dirPath)) {
            return false;
        }
        mkdir($dirPath);

        return true;
    }

    /**
     * Remove file
     *
     * @param string $filePath
     *
     * @return boolean
     */
    public static function removeFile($filePath)
    {
        if (!file_exists($filePath) || is_dir($filePath)) {
            return false;
        }
        unlink($filePath);

        return true;
    }

    /**
     * Get id of authorized use
     *
     * @param void
     *
     * @return int
     */
    public function getAuthorizedUserId()
    {
        if ($this->security->getToken()->getRoles())
            return $this->security->getToken()->getUser()->getPrimaryKey();
        else
            return 0;
    }

    /**
     * Get array of roles of authorized use
     *
     * @param void
     *
     * @return mixed array|null
     */
    public function getRolesOfAuthorizedUser()
    {
        if ($this->security->getToken()->getRoles())
            return $this->security->getToken()->getUser()->getRoles();
        else
            return null;
    }

    /**
     * Get email of authorized user
     *
     * @param void
     *
     * @return mixed string|null
     */
    public function getEmailOfAuthorizedUser()
    {
        if ($this->security->getToken()->getRoles())
            return $this->security->getToken()->getUser()->getEmail();
        else
            return null;
    }

    /**
     * Generate response message
     *
     * @param object $modelObject
     *
     * @return array Example - array('error' => '', 'success' => '')
     */
    public function generateResponseMessage($modelObject)
    {
        if ($modelObject->validate()) {
            $modelObject->save();
            $this->responseData['success'] = $this->translator->trans('common.dataSavedSuccessfully');
        }
        else {
            // Something went wrong
            foreach ($modelObject->getValidationFailures() as $failure) {
                $this->responseData['error'].= $this->translator->trans($failure->getMessage()) . '; ';
            }
        }

        return $this->responseData;
    }
}
