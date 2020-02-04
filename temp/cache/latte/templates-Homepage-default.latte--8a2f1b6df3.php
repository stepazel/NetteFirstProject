<?php
// source: C:\xampp\htdocs\NetteFirstProject\app\Presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Template8a2f1b6df3 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'title' => 'blockTitle',
	];

	public $blockTypes = [
		'content' => 'html',
		'title' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['post'])) trigger_error('Variable $post overwritten in foreach on line 5');
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		$this->renderBlock('title', get_defined_vars());
?>

<?php
		$iterations = 0;
		foreach ($posts as $post) {
?>
    <div class="post">
        <h2><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Post:show", [$post->id])) ?>"><?php
			echo LR\Filters::escapeHtmlText($post->title) /* line 7 */ ?></a></h2>
        <div class="date"><?php echo LR\Filters::escapeHtmlText(($this->filters->date)($post->created_at, 'F j, Y')) /* line 8 */ ?></div>
        <div><?php echo LR\Filters::escapeHtmlText($post->content) /* line 9 */ ?></div>
    </div>
<?php
			$iterations++;
		}
?>

<?php
		if ($user->loggedIn) {
			?>    <a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Post:create")) ?>">Napsat nový příspěvek</a>
<?php
		}
		
	}


	function blockTitle($_args)
	{
		extract($_args);
?>    <h1>Můj blog</h1>
<?php
	}

}
