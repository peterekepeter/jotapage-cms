
function markdownToHTML(text)
{
    return text
        .replace(/</g,'&lt;')
        .replace(/>/g,'&gt;')
        .replace(/#{6}([^#\n]*)#{6}?/g,'<h6>$1</h6>')
        .replace(/#{5}([^#\n]*)#{5}?/g,'<h5>$1</h5>')
        .replace(/#{4}([^#\n]*)#{4}?/g,'<h4>$1</h4>')
        .replace(/#{3}([^#\n]*)#{3}?/g,'<h3>$1</h3>')
        .replace(/#{2}([^#\n]*)#{2}?/g,'<h2>$1</h2>')
        .replace(/#{1}([^#\n]*)#{1}?/g,'<h1>$1</h1>')
        .replace(/\&gt;([^\n]*)/g,'<blockquote>$1</blockquote>')
        .replace(/\d+\.[ \t]+([^\n]+)/g,'<li class="ordered">$1</li>')       //ordered list items
        .replace(/((?:<li class="ordered">[^<]*<\/li>\s*)+)/g,'<ol>$1</ol>')    //ordered list
        .replace(/-[ \t]+([^\n]+)/g,'<li>$1</li>')       //unordered list items
        .replace(/((?:<li>[^<]*<\/li>\s*)+)/g,'<ul>$1</ul>')    //unordered list
        .replace(/((?: {4}|\t)[^\n]*((?:\s{4}|\t)[^\n]*)*)/g,'<pre><code>$1</code></pre>')
        .replace(/((?:[^\n<>]+\n)+?)(?:\s*\n|[<>])/g,'<p>$1</p>\n')
        .replace(/\*\*([^*]*)\*\*/g,'<strong>$1</strong>')
        .replace(/\*([^*]*)\*/g,'<em>$1</em>')
        .replace(/\!\[([^\]]*)\]\(([^\)]*)\)/g,'<img width="100%" src=$2>$1</a>')
        .replace(/\[([^\]]*)\]\(([^\)]*)\)/g,'<a href=$2>$1</a>')
        .replace(/-{3,}\s*\n/g,'<hr/>')
}

