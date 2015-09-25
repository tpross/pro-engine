{extends file="navigation.tpl"}
{block name="title"}
    Kernel Ausgaben
{/block}
{block name="content"}
    <div>
        {foreach $kernelMessages as $msg}
        <div>{$msg}</div>
        {/foreach}
    </div>
{/block}