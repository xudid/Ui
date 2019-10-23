<?php
namespace Xudid\MetaData\Field;


class Field
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var FieldType $type
     * @ManyToOne(target="FieldType")
     */
    private $type;

    /**
     * @var bool $readable
     */
    private $readable =false ;

    /**
     * @var bool $writable
     *
     */
    private $writable = false ;

    /**
     * @var bool $isAssociation
     */
    private $isAssociation=false;

    /**
     * @var string $assoctionClass
     */
    private $assoctionClass="";

    /**
     * @var string $associationType
     */
    private $associationType="";

    /**
     * @var string $docComment
     * @ManyToMany(targetEntity="Comment")
     */
    private $docComment="";

    /**
     * Field constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }



    /**
     * @param mixed $readable
     */
    public function setReadable()
    {
        $this->readable = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReadable():bool
    {
        return $this->readable;
    }

    /**
     * @param mixed $writable
     */
    public function setWritable()
    {
        $this->writable = true;
        return $this;
    }

    /**
     * @return
     */
    public function isWritable()
    {
        return $this->writable;
    }

    /**
     * @param bool $isAssociation
     */
    public function setIsAssociation()
    {
        $this->isAssociation = true;
    }

    /**
     * @return boolean
     */
    public function isAssociation():bool
    {
        return $this->isAssociation();
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocComment(): string
    {
        return $this->docComment;
    }

    /**
     * @param string $docComment
     */
    public function setDocComment(string $docComment)
    {
        $this->docComment = $docComment;
    }



    /**
     * @return mixed a string or null
     * if field doesn't concern an association
     */
    public function getAssociationClass()
    {
        return $this->assoctionClass;
    }

    /**
     * @param string $assoctionClass
     */
    public function setAssociationClass(string $assoctionClass)
    {
        $this->assoctionClass = $assoctionClass;
    }

    /**
     * @return string
     */
    public function getAssociationType(): string
    {
        return $this->associationType;
    }

    /**
     * @param string $associationType
     */
    public function setAssociationType(string $associationType)
    {
        $this->associationType = $associationType;
    }












}
