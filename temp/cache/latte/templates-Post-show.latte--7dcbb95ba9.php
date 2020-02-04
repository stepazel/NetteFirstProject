<?php
// source: C:\xampp\htdocs\NetteFirstProject\app\Presenters/templates/Post/show.latte

use Latte\Runtime as LR;

class Template7dcbb95ba9 extends Latte\Runtime\Template
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
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['comment'])) trigger_error('Variable $comment overwritten in foreach on line 20');
		}
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>

<p><a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("Homepage:default")) ?>">Zpět na výpis příspěvků</a></p>

<a href="<?php echo LR\Filters::escapeHtmlAttr($this->global->uiControl->link("edit", [$post->id])) ?>">Upravit příspěvek</a>

<div class="date"><?php echo LR\Filters::escapeHtmlText(($this->filters->date)($post->created_at, 'F j, Y')) /* line 7 */ ?></div>

<?php
		$this->renderBlock('title', get_defined_vars());
?>

<div class="post"><?php echo LR\Filters::escapeHtmlText($post->content) /* line 11 */ ?></div>

<h2>Vlozte novy prispevek</h2>

<?php
		/* line 15 */ $_tmp = $this->global->uiControl->getComponent("commentForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>

<h2>Comments</h2>

<div class="comments">
<?php
		$iterations = 0;
		foreach ($comments as $comment) {
			?>        <p><b><?php
			if ($this->global->ifs[] = ($comment->email)) {
				?><a href="mailto:<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($comment->email)) /* line 21 */ ?>"><?php
			}
			echo LR\Filters::escapeHtmlText($comment->name) /* line 21 */;
			if (array_pop($this->global->ifs)) {
				?></a><?php
			}
?>
</b> napsal:</p>
        <div>
            <?php echo LR\Filters::escapeHtmlText($comment->content) /* line 23 */ ?>

        </div>

<?php
			$iterations++;
		}
		?></div><?php
	}


	function blockTitle($_args)
	{
		extract($_args);
		?><h1><?php echo LR\Filters::escapeHtmlText($post->title) /* line 9 */ ?></h1>
<?php
	}

}
