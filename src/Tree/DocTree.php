<?php

namespace Tlapnet\Doxen\Tree;


use ArrayIterator;

class DocTree implements \IteratorAggregate
{


	/**
	 * @var AbstractNode
	 */
	private $homepage;


	/**
	 * @var RootNode
	 */
	private $rootNode;


	public function __construct()
	{
		$this->rootNode = new RootNode();
	}


	/**
	 * @param string $path
	 * @return AbstractNode
	 */
	public function getNode($path)
	{
		return $this->rootNode->getNode($path);
	}


	/**
	 * @param AbstractNode $node
	 * @return AbstractNode[]
	 */
	public function getBreadcrumbs(AbstractNode $node)
	{
		$parents = $node->getParents();
		array_pop($parents);

		$breadcrumb = array_merge([$node], $parents, [$this->homepage]);

		return array_reverse($breadcrumb);
	}


	/**
	 * @param AbstractNode $homepage
	 */
	public function setHomepage(AbstractNode $homepage)
	{
		$this->homepage = $homepage;
	}


	/**
	 * @return AbstractNode
	 */
	public function getHomepage()
	{
		return $this->homepage;
	}


	/**
	 * @return AbstractNode[]
	 */
	public function getNodes()
	{
		return $this->rootNode->getNodes();
	}


	/**
	 * @param AbstractNode $node
	 */
	public function addNode(AbstractNode $node)
	{
		$this->rootNode->addNode($node);
	}


	/**
	 * @return ArrayIterator
	 */
	public function getIterator()
	{
		return new ArrayIterator($this->getNodes());
	}

}
