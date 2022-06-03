<?php

namespace Translation;

use Ui\Translation\FileSource;
use Ui\Translation\Translator;
use PHPUnit\Framework\TestCase;

class TranslatorTest extends TestCase
{
    private string $fileName;

    protected function setUp():void
    {
        $this->fileName = sys_get_temp_dir()  .DIRECTORY_SEPARATOR . 'FR.php';
        $this->source = new FileSource($this->fileName);
    }

    protected function tearDown():void
    {
        $this->source->reset();
    }

    /**
     * @test
     */
    public function translateAnEmptyFieldReturnEmptyTranslation()
    {
        file_put_contents($this->fileName, '<?php return ["aze" => "aze"];');
        $this->source = new FileSource($this->fileName);
        $translator = new Translator($this->source);
        $result = $translator->translate('');
        $this->assertEmpty($result);
    }

    /**
     * @test
     */
    public function translateWithAnEmptySourceReturnEmptyTranslation()
    {
        file_put_contents($this->fileName, '<?php return [];');
        $translator = new Translator($this->source);
        $result = $translator->translate('');
        $this->assertEmpty($result);
    }
}
