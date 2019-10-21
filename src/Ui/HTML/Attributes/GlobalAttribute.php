<?php
namespace Ui\HTML\Attributes;

use Ui\Utils\Enum;

/**
 * This file contains GlobalAttribute class and its methods.
 * @package Ui\HTML\Attributes
 * @author Didier Moindreau
 * GlobalAttribute class contains HTML elements common attributes
 */
class GlobalAttribute extends Enum
{
    const ACCESSKEY = "accesskey";
    const _CLASS = "class";
    const CONTENT_EDITABLE = "contenteditable";
    const CONTEXT_MENU = "contextmenu";
    const DIR = "dir";
    const DRAGGABLE = "draggable";
    const DROPZONE = "dropzone";
    const HIDDEN = "hidden";
    const ID = "id";
    const LANG = "lang";
    const SPELLCHECK = "spellcheck";
    const STYLE = "style";
    const TAB_INDEX = "tabindex";
    const TITLE = "title";
    const TRANSLATE = "translate";
    const ON_ABORT="onabort"  ;
    const ON_AFTER_PRINT="onafterprint"  ;
    const ON_BEFORE_PRINT="onbeforeprint"  ;
    const ON_BEFORE_UNLOAD="onbeforeunload"  ;
    const ON_BLUR="onblur"  ;
    const ON_CANPLAY="oncanplay"  ;
    const ON_CAN_PLAY_THROUGH="oncanplaythrough"  ;
    const ON_CHANGE="onchange"  ;
    const ON_CLICK="onclick"  ;
    const ON_CONTEXT_MENU="oncontextmenu"  ;
    const ON_COPY="oncopy"  ;
    const ON_CUE_CHANGE="oncuechange"  ;
    const ON_CUT="oncut"  ;
    const ON_DBL_CLICK="ondblclick"  ;
    const ON_DRAG="ondrag"  ;
    const ON_DRAG_END="ondragend"  ;
    const ON_DRAG_ENTER="ondragenter"  ;
    const ON_DRAG_LEAVE="ondragleave"  ;
    const ON_DRAG_OVER="ondragover"  ;
    const ON_DRAG_START="ondragstart"  ;
    const ON_DROP="ondrop"  ;
    const ON_DURATION_CHANGE="ondurationchange"  ;
    const ON_EMPTIED="onemptied"  ;
    const ON_ENDED="onended"  ;
    const ON_ERROR="onerror"  ;
    const ON_FOCUS="onfocus"  ;
    const ON_HASH_CHANGE="onhashchange"  ;
    const ON_INPUT="oninput"  ;
    const ON_INVALID="oninvalid"  ;
    const ON_KEY_DOWN="onkeydown"  ;
    const ON_KEY_PRESS="onkeypress"  ;
    const ON_KEY_UP="onkeyup"  ;
    const ON_LOAD="onload"  ;
    const ON_LOADED_DATA="onloadeddata"  ;
    const ON_LOADED_METADATA="onloadedmetadata"  ;
    const ON_LOAD_START="onloadstart"  ;
    const ON_MESSAGE="onmessage"  ;
    const ON_MOUSE_DOWN="onmousedown"  ;
    const ON_MOUSE_MOVE="onmousemove"  ;
    const ON_MOUSE_OUT="onmouseout"  ;
    const ON_MOUSE_OVER="onmouseover"  ;
    const ON_MOUSE_UP="onmouseup"  ;
    const ON_MOUSE_WHEEL="onmousewheel"  ;
    const ON_OFFLINE="onoffline"  ;
    const ON_ONLINE="ononline"  ;
    const ON_PAGE_HIDE="onpagehide"  ;
    const ON_PAGE_SHOW="onpageshow"  ;
    const ON_PASTE="onpaste"  ;
    const ON_PAUSE="onpause"  ;
    const ON_PLAY="onplay"  ;
    const ON_PLAYING="onplaying"  ;
    const ON_POP_STATE="onpopstate"  ;
    const ON_PROGRESS="onprogress"  ;
    const ON_RATE_CHANGE="onratechange"  ;
    const ON_RESET="onreset"  ;
    const ON_RESIZE="onresize"  ;
    const ON_SCROLL="onscroll"  ;
    const ON_SEARCH="onsearch"  ;
    const ON_SEEKED="onseeked"  ;
    const ON_SEEKING="onseeking"  ;
    const ON_SELECT="onselect"  ;
    const ON_SHOW="onshow"  ;
    const ON_STALLED="onstalled"  ;
    const ON_STORAGE="onstorage"  ;
    const ON_SUBMIT="onsubmit"  ;
    const ON_SUSPEND="onsuspend"  ;
    const ON_TIME_UPDATE="ontimeupdate"  ;
    const ON_TOGGLE="ontoggle"  ;
    const ON_UNLOAD="onunload"  ;
    const ON_VOLUME_CHANGE="onvolumechange"  ;
    const ON_WAITING="onwaiting"  ;
    const ON_WHEEL="onwheel"  ;

    /** @var string Should contain the attribute name */
    protected $name = "";

    /** @var mixed Should contain the attribute value */
    protected $value = "";

    /** @var array Should contain valid attributes  */
    protected $validAttributes;

    /**
     * Construct the Attribute from its name and value
     * @param string $name the name of the Attribute
     * @param mixed $value the value of the Attribute a string or an array
     * for the class attribute
     */
    public function __construct($name, $value)
    {
        parent::__construct($name);
        $this->value = $value;
    }

    /**
     * Return the Attribute as a string
     * @return string
     */
    public function __toString()
    {
        $string = $this->name . '="' . $this->value . '"';
        return $string;
    }
}
