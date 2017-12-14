<?php

namespace Tlapnet\Doxen\Bridge\Parsedown;

use Nette\Bridges\ApplicationLatte\Template;
use Tlapnet\Doxen\Event\NodeEvent;
use Tlapnet\Doxen\Listener\AbstractNodeListener;
use Tlapnet\Doxen\Widget\WidgetManager;
use Tlapnet\Doxen\Widget\Widgets;

class TOCDecorator extends AbstractNodeListener
{

	/**
	 * @param NodeEvent $event
	 * @return void
	 */
	public function decorateNode(NodeEvent $event)
	{
		if (!($node = $this->getTextNode($event))) return;

		$parsedown = new DoxenParsedown($event->getControl());
		$parsedown->text($node->getRawContent());
		$elements = $parsedown->getElements();

		$wm = new WidgetManager($node);
		$wm->get(Widgets::PAGE_TOC)->add('toc', function (Template $template) use ($elements) {
			$template->setFile(__DIR__ . '/template/toc.latte');
			$template->elements = $elements;

			return $template;
		});
	}

}
