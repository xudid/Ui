<?php
namespace Brick\Ui\HTML\Attributes;
#require("../../vendor/autoload.php");

use Brick\Utils\Enum;
//use phpDocumentor\Reflection\Types\This;

/**
 *
 * @author didux
 *
 */
class GlobalAttribute extends Enum
{

    /**
     */
    const accesskeyAttribute = "accesskey";

    const classAttribute = "class";

    const contenteditableAttribute = "contenteditable";

    const contextmenuAttribute = "contextmenu";

    const dirAttribute = "dir";

    const draggableAttribute = "draggable";

    const dropzoneAttribute = "dropzone";

    const hiddenAttribute = "hidden";

    const idAttribute = "id";

    const langAttribute = "lang";

    const spellcheckAttribute = "spellcheck";

    const styleAttribute = "style";

    const tabindexAttribute = "tabindex";

    const titleAttribute = "title";

    const translateAttribute = "translate";
    const onabort="onabort"  ;
    const onafterprint="onafterprint"  ;
    const onbeforeprint="onbeforeprint"  ;
    const onbeforeunload="onbeforeunload"  ;
    const onblur="onblur"  ;
    const oncanplay="oncanplay"  ;
    const oncanplaythrough="oncanplaythrough"  ;
    const onchange="onchange"  ;
    const onclick="onclick"  ;
    const oncontextmenu="oncontextmenu"  ;
    const oncopy="oncopy"  ;
    const oncuechange="oncuechange"  ;
    const oncut="oncut"  ;
    const ondblclick="ondblclick"  ;
    const ondrag="ondrag"  ;
    const ondragend="ondragend"  ;
    const ondragenter="ondragenter"  ;
    const ondragleave="ondragleave"  ;
    const ondragover="ondragover"  ;
    const ondragstart="ondragstart"  ;
    const ondrop="ondrop"  ;
    const ondurationchange="ondurationchange"  ;
    const onemptied="onemptied"  ;
    const onended="onended"  ;
    const onerror="onerror"  ;
    const onfocus="onfocus"  ;
    const onhashchange="onhashchange"  ;
    const oninput="oninput"  ;
    const oninvalid="oninvalid"  ;
    const onkeydown="onkeydown"  ;
    const onkeypress="onkeypress"  ;
    const onkeyup="onkeyup"  ;
    const onload="onload"  ;
    const onloadeddata="onloadeddata"  ;
    const onloadedmetadata="onloadedmetadata"  ;
    const onloadstart="onloadstart"  ;
    const onmessage="onmessage"  ;
    const onmousedown="onmousedown"  ;
    const onmousemove="onmousemove"  ;
    const onmouseout="onmouseout"  ;
    const onmouseover="onmouseover"  ;
    const onmouseup="onmouseup"  ;
    const onmousewheel="onmousewheel"  ;
    const onoffline="onoffline"  ;
    const ononline="ononline"  ;
    const onpagehide="onpagehide"  ;
    const onpageshow="onpageshow"  ;
    const onpaste="onpaste"  ;
    const onpause="onpause"  ;
    const onplay="onplay"  ;
    const onplaying="onplaying"  ;
    const onpopstate="onpopstate"  ;
    const onprogress="onprogress"  ;
    const onratechange="onratechange"  ;
    const onreset="onreset"  ;
    const onresize="onresize"  ;
    const onscroll="onscroll"  ;
    const onsearch="onsearch"  ;
    const onseeked="onseeked"  ;
    const onseeking="onseeking"  ;
    const onselect="onselect"  ;
    const onshow="onshow"  ;
    const onstalled="onstalled"  ;
    const onstorage="onstorage"  ;
    const onsubmit="onsubmit"  ;
    const onsuspend="onsuspend"  ;
    const ontimeupdate="ontimeupdate"  ;
    const ontoggle="ontoggle"  ;
    const onunload="onunload"  ;
    const onvolumechange="onvolumechange"  ;
    const onwaiting="onwaiting"  ;
    const onwheel="onwheel"  ;

    protected $name = "";

    protected $value = "";

    protected $validAttributes;

    public function __construct($name, $value)
    {
        parent::__construct($name);
        $this->value = $value;
    }

    public function __toString()
    {
        $string = $this->name . '="' . $this->value . '"';
        return $string;
    }
}
