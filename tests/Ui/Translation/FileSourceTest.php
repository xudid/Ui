<?php

namespace Ui\Translation;

use PHPUnit\Framework\TestCase;

class FileSourceTest extends TestCase
{
    private string $fileName;
    private SourceInterface $source;


    protected function setUp():void
    {
        $this->fileName = sys_get_temp_dir()  .DIRECTORY_SEPARATOR . 'FR.php';

    }

    public function initSource($content = '')
    {
        if ($content) {
            file_put_contents($this->fileName, $content);
        }
    }

    protected function tearDown():void
    {
        FileSource::reset();
        @unlink($this->fileName);
    }

    /**
     * @test
     */
    public function createSourceWhenSourcePathIsEmptyThrowException()
    {
        $this->expectException(UnavailableSourceException::class);
        new FileSource('');
    }

    /**
     *  @test
     */
    public function createSourceWhenSourceFileDoesNotExistThrowException()
    {
        $this->expectException(UnavailableSourceException::class);
        new FileSource($this->fileName);
    }

    /**
     * @test
     */
    public function getFieldTranslationWhenFileIsEmptyThrowInvalidSourceException()
    {
        $this->expectException(InvalidSourceException::class);
        $source = $this->getSource();
        $this->source->get('test');
    }

    /**
     * @test
     */
    public function getFieldTranslationWhenSourceIsEmptyThrowEmptySourceException()
    {
        $this->expectException(EmptySourceException::class);
        file_put_contents($this->fileName, '<?php return [];');
        $this->source->get('test');
    }

    /**
     * @test
     */
    public function getFieldTranslationWhenNoTranslationThrowTranslationNotFoundException()
    {
        $this->expectException(TranslationNotFoundException::class);
        file_put_contents($this->fileName, '<?php return ["aze" => "aze"];');
        $this->source->get('test');
    }

    /**
     * @test
     */
    public function getTranslationByFieldNameReturnTheRightTranslation()
    {
        file_put_contents($this->fileName, '<?php return ["aze" => "aze"];');
        $result = $this->source->get('aze');
        $this->assertEquals('aze', $result);
    }
}
