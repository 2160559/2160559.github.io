<?php
class User
{
    private $user_id;
    private $username;
    private $first_name;
    private $last_name;
    private $acc_type;
    private $email_add;
    private $password;
    private $birth_date;
    private $profile_img;
    private $phone_number;

    /**
     * User constructor.
     * @param $user_id
     * @param $username
     * @param $first_name
     * @param $last_name
     * @param $acc_type
     * @param $email_add
     * @param $password
     * @param $birth_date
     * @param $profile_img
     * @param $phone_number
     */
    public function __construct($user_id, $username, $first_name, $last_name, $acc_type,
                                $email_add, $password, $birth_date, $profile_img, $phone_number)
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->acc_type = $acc_type;
        $this->email_add = $email_add;
        $this->password = $password;
        $this->birth_date = $birth_date;
        $this->profile_img = "data:image;base64" . base64_decode($profile_img);
        $this->phone_number = $phone_number;
    }
    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getAccType()
    {
        return $this->acc_type;
    }

    /**
     * @param mixed $acc_type
     */
    public function setAccType($acc_type)
    {
        $this->acc_type = $acc_type;
    }

    /**
     * @return mixed
     */
    public function getEmailAdd()
    {
        return $this->email_add;
    }

    /**
     * @param mixed $email_add
     */
    public function setEmailAdd($email_add)
    {
        $this->email_add = $email_add;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * @param mixed $birth_date
     */
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;
    }

    /**
     * @return mixed
     */
    public function getProfileImg()
    {
        return $this->profile_img;
    }

    /**
     * @param mixed $profile_img
     */
    public function setProfileImg($profile_img)
    {
        $this->profile_img = $profile_img;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }
}