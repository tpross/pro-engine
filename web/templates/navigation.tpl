{extends file="body.tpl"}
{block name="navigation"}
    <!-- Navigation start -->
    <nav>
        <ul>
            <li>
                <a href="index.php?content=home">{if $contentActive eq 'home'}<strong>Home</strong>{else}Home{/if}</a>
            </li>
            <li>
                <a href="index.php?content=content1">{if $contentActive eq 'content1'}<strong>Content 1</strong>{else}Content 1{/if}</a>
            </li>
            <li>
                <a href="index.php?content=content2">{if $contentActive eq 'content2'}<strong>Content 2</strong>{else}Content 2{/if}</a>
            </li>
            <li>
                <a href="index.php?content=kernelMessages">{if $contentActive eq 'kernelMessages'}<strong>Kernel Ausgaben</strong>{else}Kernel Ausgaben{/if}</a>
            </li>
        </ul>
        <hr />
    </nav>
{*
    <nav>
        <ul>
            <li>
                <a href="index.php?content=home">Home</a>
            </li>
            <li>
                <a href="index.php?content=content1">Content 1</a>
            </li>
            <li>
                <a href="index.php?content=content2">Content 2</a>
            </li>
        </ul>
    </nav>
*}
    <!-- Navigation end -->
{/block}
