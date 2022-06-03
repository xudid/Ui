<?php

namespace Ui\Widgets\Cards;

use Ui\HTML\Elements\Bases\H5;
use Ui\HTML\Elements\Bases\H6;
use Ui\HTML\Elements\ElementInterface;
use Ui\HTML\Elements\Nested\Div;
use Ui\HTML\Elements\Nested\P;

/**
 * Class Info
 * @package X\Widget\Cards
 */
class Info extends Div
{
	private $title;

	private $subtitle;

	private $text;

	private $links = [];

	private $header;

	private $body;

	private $footer;


	/**
	 * InfoCard constructor.
	 * @param string $title
	 * @param string $text
	 * @param string $subtitle
	 */
	public function __construct(string $title = '', $text = '', string $subtitle = '')
	{
		parent::__construct();
		$this->setClass('card shadow m-2');
		if ($title) {
			$this->title = (new H5($title))->setClass('card-title text-primary');
			$this->header = (new Div($this->title))->setClass('card-header');
			$this->add($this->header);
		}
		if ($text instanceof ElementInterface) {
			$this->text = $text;
		} else {
			$this->text = new P($text);
		}

		!empty($subtitle) ? $this->subtitle = (new H6($subtitle))->setClass('card-subtitle mb-2 text-muted'):null;
		$this->body = (new Div())
			->setClass('card-body')
			->feed(
				$this->subtitle,
				$this->text,
				implode(',', $this->links)
			);
		$this->footer = (new Div())->setClass('card-footer');
		$this->feed($this->body, $this->footer);
		return $this;
	}
}
