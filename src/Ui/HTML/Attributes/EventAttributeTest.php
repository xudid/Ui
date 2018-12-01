<?php
namespace block\attributes;
require_once 'EventAttribute.php';
require_once '../Utils/Enum.php';
use block\Attributes\EventAttribute;
use PHPUnit_Framework_TestCase;

/**
 * test case.
 */
class EventAttributesTest extends PHPUnit_Framework_TestCase
{

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated GlobalAttributesTest::setUp()
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated GlobalAttributesTest::tearDown()
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    public function testCanContructEventAttribute()
    {
        $attr = new EventAttribute(EventAttribute::onclick, "test");
    }
    
    public function testonabortEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onabort,"alert()");
        $r = $ea::onabort;
        $this->assertEquals("onabort", $r);
    }
    public function testonafterprintEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onafterprint,"alert()");
        $r = $ea::onafterprint;
        $this->assertEquals("onafterprint", $r);
    }
    public function testonbeforeprintEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onbeforeprint,"alert()");
        $r = $ea::onbeforeprint;
        $this->assertEquals("onbeforeprint", $r);
    }
    public function testonbeforeunloadEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onbeforeunload,"alert()");
        $r = $ea::onbeforeunload;
        $this->assertEquals("onbeforeunload", $r);
    }
    public function testonblurEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onblur,"alert()");
        $r = $ea::onblur;
        $this->assertEquals("onblur", $r);
    }
    public function testoncanplayEventNameValue(){
        $ea = new EventAttribute(EventAttribute::oncanplay,"alert()");
        $r = $ea::oncanplay;
        $this->assertEquals("oncanplay", $r);
    }
    public function testoncanplaythroughEventNameValue(){
        $ea = new EventAttribute(EventAttribute::oncanplaythrough,"alert()");
        $r = $ea::oncanplaythrough;
        $this->assertEquals("oncanplaythrough", $r);
    }
    public function testonchangeEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onchange,"alert()");
        $r = $ea::onchange;
        $this->assertEquals("onchange", $r);
    }
    public function testonclickEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onclick,"alert()");
        $r = $ea::onclick;
        $this->assertEquals("onclick", $r);
    }
    public function testoncontextmenuEventNameValue(){
        $ea = new EventAttribute(EventAttribute::oncontextmenu,"alert()");
        $r = $ea::oncontextmenu;
        $this->assertEquals("oncontextmenu", $r);
    }
    public function testoncopyEventNameValue(){
        $ea = new EventAttribute(EventAttribute::oncopy,"alert()");
        $r = $ea::oncopy;
        $this->assertEquals("oncopy", $r);
    }
    public function testoncuechangeEventNameValue(){
        $ea = new EventAttribute(EventAttribute::oncuechange,"alert()");
        $r = $ea::oncuechange;
        $this->assertEquals("oncuechange", $r);
    }
    public function testoncutEventNameValue(){
        $ea = new EventAttribute(EventAttribute::oncut,"alert()");
        $r = $ea::oncut;
        $this->assertEquals("oncut", $r);
    }
    public function testondblclickEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ondblclick,"alert()");
        $r = $ea::ondblclick;
        $this->assertEquals("ondblclick", $r);
    }
    public function testondragEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ondrag,"alert()");
        $r = $ea::ondrag;
        $this->assertEquals("ondrag", $r);
    }
    public function testondragendEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ondragend,"alert()");
        $r = $ea::ondragend;
        $this->assertEquals("ondragend", $r);
    }
    public function testondragenterEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ondragenter,"alert()");
        $r = $ea::ondragenter;
        $this->assertEquals("ondragenter", $r);
    }
    public function testondragleaveEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ondragleave,"alert()");
        $r = $ea::ondragleave;
        $this->assertEquals("ondragleave", $r);
    }
    public function testondragoverEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ondragover,"alert()");
        $r = $ea::ondragover;
        $this->assertEquals("ondragover", $r);
    }
    public function testondragstartEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ondragstart,"alert()");
        $r = $ea::ondragstart;
        $this->assertEquals("ondragstart", $r);
    }
    public function testondropEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ondrop,"alert()");
        $r = $ea::ondrop;
        $this->assertEquals("ondrop", $r);
    }
    public function testondurationchangeEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ondurationchange,"alert()");
        $r = $ea::ondurationchange;
        $this->assertEquals("ondurationchange", $r);
    }
    public function testonemptiedEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onemptied,"alert()");
        $r = $ea::onemptied;
        $this->assertEquals("onemptied", $r);
    }
    public function testonendedEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onended,"alert()");
        $r = $ea::onended;
        $this->assertEquals("onended", $r);
    }
    public function testonerrorEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onerror,"alert()");
        $r = $ea::onerror;
        $this->assertEquals("onerror", $r);
    }
    public function testonfocusEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onfocus,"alert()");
        $r = $ea::onfocus;
        $this->assertEquals("onfocus", $r);
    }
    public function testonhashchangeEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onhashchange,"alert()");
        $r = $ea::onhashchange;
        $this->assertEquals("onhashchange", $r);
    }
    public function testoninputEventNameValue(){
        $ea = new EventAttribute(EventAttribute::oninput,"alert()");
        $r = $ea::oninput;
        $this->assertEquals("oninput", $r);
    }
    public function testoninvalidEventNameValue(){
        $ea = new EventAttribute(EventAttribute::oninvalid,"alert()");
        $r = $ea::oninvalid;
        $this->assertEquals("oninvalid", $r);
    }
    public function testonkeydownEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onkeydown,"alert()");
        $r = $ea::onkeydown;
        $this->assertEquals("onkeydown", $r);
    }
    public function testonkeypressEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onkeypress,"alert()");
        $r = $ea::onkeypress;
        $this->assertEquals("onkeypress", $r);
    }
    public function testonkeyupEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onkeyup,"alert()");
        $r = $ea::onkeyup;
        $this->assertEquals("onkeyup", $r);
    }
    public function testonloadEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onload,"alert()");
        $r = $ea::onload;
        $this->assertEquals("onload", $r);
    }
    public function testonloadeddataEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onloadeddata,"alert()");
        $r = $ea::onloadeddata;
        $this->assertEquals("onloadeddata", $r);
    }
    public function testonloadedmetadataEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onloadedmetadata,"alert()");
        $r = $ea::onloadedmetadata;
        $this->assertEquals("onloadedmetadata", $r);
    }
    public function testonloadstartEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onloadstart,"alert()");
        $r = $ea::onloadstart;
        $this->assertEquals("onloadstart", $r);
    }
    public function testonmessageEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onmessage,"alert()");
        $r = $ea::onmessage;
        $this->assertEquals("onmessage", $r);
    }
    public function testonmousedownEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onmousedown,"alert()");
        $r = $ea::onmousedown;
        $this->assertEquals("onmousedown", $r);
    }
    public function testonmousemoveEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onmousemove,"alert()");
        $r = $ea::onmousemove;
        $this->assertEquals("onmousemove", $r);
    }
    public function testonmouseoutEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onmouseout,"alert()");
        $r = $ea::onmouseout;
        $this->assertEquals("onmouseout", $r);
    }
    public function testonmouseoverEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onmouseover,"alert()");
        $r = $ea::onmouseover;
        $this->assertEquals("onmouseover", $r);
    }
    public function testonmouseupEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onmouseup,"alert()");
        $r = $ea::onmouseup;
        $this->assertEquals("onmouseup", $r);
    }
    public function testonmousewheelEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onmousewheel,"alert()");
        $r = $ea::onmousewheel;
        $this->assertEquals("onmousewheel", $r);
    }
    public function testonofflineEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onoffline,"alert()");
        $r = $ea::onoffline;
        $this->assertEquals("onoffline", $r);
    }
    public function testononlineEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ononline,"alert()");
        $r = $ea::ononline;
        $this->assertEquals("ononline", $r);
    }
    public function testonpagehideEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onpagehide,"alert()");
        $r = $ea::onpagehide;
        $this->assertEquals("onpagehide", $r);
    }
    public function testonpageshowEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onpageshow,"alert()");
        $r = $ea::onpageshow;
        $this->assertEquals("onpageshow", $r);
    }
    public function testonpasteEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onpaste,"alert()");
        $r = $ea::onpaste;
        $this->assertEquals("onpaste", $r);
    }
    public function testonpauseEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onpause,"alert()");
        $r = $ea::onpause;
        $this->assertEquals("onpause", $r);
    }
    public function testonplayEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onplay,"alert()");
        $r = $ea::onplay;
        $this->assertEquals("onplay", $r);
    }
    public function testonplayingEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onplaying,"alert()");
        $r = $ea::onplaying;
        $this->assertEquals("onplaying", $r);
    }
    public function testonpopstateEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onpopstate,"alert()");
        $r = $ea::onpopstate;
        $this->assertEquals("onpopstate", $r);
    }
    public function testonprogressEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onprogress,"alert()");
        $r = $ea::onprogress;
        $this->assertEquals("onprogress", $r);
    }
    public function testonratechangeEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onratechange,"alert()");
        $r = $ea::onratechange;
        $this->assertEquals("onratechange", $r);
    }
    public function testonresetEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onreset,"alert()");
        $r = $ea::onreset;
        $this->assertEquals("onreset", $r);
    }
    public function testonresizeEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onresize,"alert()");
        $r = $ea::onresize;
        $this->assertEquals("onresize", $r);
    }
    public function testonscrollEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onscroll,"alert()");
        $r = $ea::onscroll;
        $this->assertEquals("onscroll", $r);
    }
    public function testonsearchEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onsearch,"alert()");
        $r = $ea::onsearch;
        $this->assertEquals("onsearch", $r);
    }
    public function testonseekedEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onseeked,"alert()");
        $r = $ea::onseeked;
        $this->assertEquals("onseeked", $r);
    }
    public function testonseekingEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onseeking,"alert()");
        $r = $ea::onseeking;
        $this->assertEquals("onseeking", $r);
    }
    public function testonselectEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onselect,"alert()");
        $r = $ea::onselect;
        $this->assertEquals("onselect", $r);
    }
    public function testonshowEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onshow,"alert()");
        $r = $ea::onshow;
        $this->assertEquals("onshow", $r);
    }
    public function testonstalledEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onstalled,"alert()");
        $r = $ea::onstalled;
        $this->assertEquals("onstalled", $r);
    }
    public function testonstorageEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onstorage,"alert()");
        $r = $ea::onstorage;
        $this->assertEquals("onstorage", $r);
    }
    public function testonsubmitEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onsubmit,"alert()");
        $r = $ea::onsubmit;
        $this->assertEquals("onsubmit", $r);
    }
    public function testonsuspendEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onsuspend,"alert()");
        $r = $ea::onsuspend;
        $this->assertEquals("onsuspend", $r);
    }
    public function testontimeupdateEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ontimeupdate,"alert()");
        $r = $ea::ontimeupdate;
        $this->assertEquals("ontimeupdate", $r);
    }
    public function testontoggleEventNameValue(){
        $ea = new EventAttribute(EventAttribute::ontoggle,"alert()");
        $r = $ea::ontoggle;
        $this->assertEquals("ontoggle", $r);
    }
    public function testonunloadEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onunload,"alert()");
        $r = $ea::onunload;
        $this->assertEquals("onunload", $r);
    }
    public function testonvolumechangeEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onvolumechange,"alert()");
        $r = $ea::onvolumechange;
        $this->assertEquals("onvolumechange", $r);
    }
    public function testonwaitingEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onwaiting,"alert()");
        $r = $ea::onwaiting;
        $this->assertEquals("onwaiting", $r);
    }
    public function testonwheelEventNameValue(){
        $ea = new EventAttribute(EventAttribute::onwheel,"alert()");
        $r = $ea::onwheel;
        $this->assertEquals("onwheel", $r);
    }
}
?>