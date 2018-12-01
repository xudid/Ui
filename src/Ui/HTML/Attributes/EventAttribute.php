<?php
namespace Brick\Ui\HTML\Attributes;
require_once '../Utils/Enum.php';
use Brick\Utils\Enum;
class EventAttribute extends Enum{

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

    protected $name;
    protected $value;

    public function __construct($name,$value){
        parent::__construct($name);
        $this->value = $value;

    }
    public function __toString(){
        $string = $this->name . '="' . $this->value . '"';
        return $string;
    }
}
?>
