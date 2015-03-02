<?php

namespace Regitec\Entities;

use Intervention\Image\ImageManager;

class User
{
    private $firsname;

    private $lastname;

    private $patronymic;

    private $password;

    private $email;

    private $phone;

    private $iconAvatar;

    private $previewAvatar;

    private $largeAvatar;

    public function __construct(array $data)
    {
        $this->setFirsname($data['firstname']);
        $this->setLastname($data['lastname']);
        $this->setPatronymic($data['patronymic']);
        $this->setPassword($data['password']);
        $this->setEmail($data['email']);
        $this->setPhone($data['phone']);
        $this->getImage($data['avatar']);
    }

    /**
     * @return mixed
     */
    public function getFirsname()
    {
        return $this->firsname;
    }

    /**
     * @param mixed $firsname
     */
    public function setFirsname($firsname)
    {
        $this->firsname = $firsname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @param mixed $patronymic
     */
    public function setPatronymic($patronymic)
    {
        $this->patronymic = $patronymic;
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
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getIconAvatar()
    {
        return $this->iconAvatar;
    }

    /**
     * @param mixed $iconAvatar
     */
    public function setIconAvatar($iconAvatar)
    {
        $this->iconAvatar = $iconAvatar;
    }

    /**
     * @return mixed
     */
    public function getPreviewAvatar()
    {
        return $this->previewAvatar;
    }

    /**
     * @param mixed $previewAvatar
     */
    public function setPreviewAvatar($previewAvatar)
    {
        $this->previewAvatar = $previewAvatar;
    }

    /**
     * @return mixed
     */
    public function getLargeAvatar()
    {
        return $this->largeAvatar;
    }

    /**
     * @param mixed $largeAvatar
     */
    public function setLargeAvatar($largeAvatar)
    {
        $this->largeAvatar = $largeAvatar;
    }

    public function getImage($image)
    {
        $imgDir = realpath(__DIR__.'/../../public/images/');
        $saveDir = '/images';
        //var_dump($saveDir);
        //exit();
        $extension = $image->guessExtension();
        $imgIconName = $this->getEmail().'_icon.'.$extension;
        $imgPreviewName = $this->getEmail().'_preview.'.$extension;
        $imgLargeName = $this->getEmail().'_large.'.$extension;
        $image->move($imgDir, $imgLargeName);

        $manager = new ImageManager(array('driver' => 'imagick'));

        $image = $manager->make($imgDir.'/'.$imgLargeName)->resize(150, 150);
        $image->save($imgDir.'/'.$imgPreviewName);

        $image = $manager->make($imgDir.'/'.$imgLargeName)->resize(50, 50);
        $image->save($imgDir.'/'.$imgIconName);

        $this->setLargeAvatar($saveDir.'/'.$imgLargeName);
        $this->setIconAvatar($saveDir.'/'.$imgIconName);
        $this->setPreviewAvatar($saveDir.'/'.$imgPreviewName);
    }

    public function getAllData()
    {
        $data = [];
        $data['firstname'] = $this->getFirsname();
        $data['lastname'] = $this->getLastname();
        $data['patronymic'] = $this->getPatronymic();
        $data['password'] = $this->getPassword();
        $data['email'] = $this->getEmail();
        $data['phone'] = $this->getPhone();
        $data['iconAvatar'] = $this->getIconAvatar();
        $data['previewAvatar'] = $this->getPreviewAvatar();
        $data['largeAvatar'] = $this->getLargeAvatar();

        return $data;
    }
}