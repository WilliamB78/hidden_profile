<?php



namespace Service;

use Entity\Company;
use Symfony\Component\HttpFoundation\Session\Session;


class CompanyManager 
{
   private $session;

    /**
     * UserManager constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param string $plainPassword
     * @return string
     */
    public function encodePassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    /**
     * @param string $plainPassword
     * @param string $encodedPassword
     * @return bool
     */
    public function verifyPassword($plainPassword, $encodedPassword)
    {
        return password_verify($plainPassword, $encodedPassword);
    }

   
    public function login(Company $company)
    {
        $this->session->set('company', $company);
    }

    public function logout()
    {
        $this->session->remove('company');
    }

    
    public function getCompany()
    {
        return $this->session->get('company');
    }
    
     public function getCompanyName()
    {
        if ($this->session->has('company')) {
            return $this->session->get('company')->getName();
        }

        return '';
    }


    public function isCompany()
    {
        return $this->session->has('company') && $this->session->get('company')->isCompany();
    }
    
//    public function isTemp()
//    {
//        return $this->session->has('temp') && $this->session->get('temp')->isTemp(); // PENSER A FAIRE LA VIEW CORRESPONDANTE DANS LESPACE ENTREPRISE //////
//    }
}
