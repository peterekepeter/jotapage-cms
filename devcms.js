
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
        .replace(/((?: {4}|\t)[^\n]*((?:\s{4}|\t)[^\n]*)*)/g,'<pre><code> \n $1 \n </code></pre>')
        .replace(/((?:[^\n<>]+\n)+?)(?:\s*\n|[<>])/g,'<p>$1</p>\n')
        .replace(/\*\*([^*]*)\*\*/g,'<strong>$1</strong>')
        .replace(/\*([^*]*)\*/g,'<em>$1</em>')
        .replace(/\!\[([^\]]*)\]\(([^\)]*)\)/g,'<img width="max-width:100%" src=$2>$1</a>')
        .replace(/\[([^\]]*)\]\(([^\)]*)\)/g,'<a href=$2>$1</a>')
        .replace(/-{3,}\s*\n/g,'<hr/>')
}

function editorFormat(txtarea, prepend, content, append) {
    var delta = txtarea.selectionEnd - txtarea.selectionStart;
    var middle = $(txtarea).val().substring(txtarea.selectionStart, txtarea.selectionEnd);
    if (delta == 0)
    {
        middle = content;
    }
    $(txtarea).val(
        $(txtarea).val().substring(0, txtarea.selectionStart)+
            prepend + middle + append +
            $(txtarea).val().substring(txtarea.selectionEnd)
    );
    $(txtarea).trigger("change");
}

function menuLogout()
{
    $(".content").html('');
    $.ajax({
        url: "logout.php"
    })
    .done(function( data ) {
        window.location = 'login.html';
    });
}

function menuUsers()
{
    $(".content").load('page/userView.html',function(data){
        loadUserTableContent();
        $('#submit').click(function(){
            var username = $('#username').val();
            var password = $('#password').val();
            var email = $('#email').val();
            var level = $('#level').val();
            $.post('userController.php',
                "cmd=create&username="+username
                    +"&password="+password
                    +"&email="+email
                    +"&level="+level,loadUserTableContent);
        });
    });
}

function menuArticles()
{
    $(".content").html('').load('page/articleView.html',function(data){
        loadArticleTableContent();
        $('#submit').click(function(){
            var title = $('#title').val();
            $.post('articleController.php',
                "cmd=create&title="+title,loadArticleTableContent);
        });
    });
}

function menuFiles()
{
    $(".content").html('');
}

function menuAccount()
{
    $(".content").html('');
}


function loadUserTableContent()
{
    $('.userTableContent').load('userController.php',function(){
        $('.entity').append("<td><button class='noborder'>delete</button></td>");
        $('.userTableContent button').click(function(){
            var username = $(this).parent().parent().attr('content');
            $.post('userController.php',
                "cmd=delete&username="+username,loadUserTableContent);
        });
    });
}

global_idarticle = 0;

function updateArticle(idarticle,title,markdown,html)
{
    $.post('articleController.php',
        { cmd: "update", title:title, idarticle:idarticle, markdown: markdown, html:html });
}

function loadArticleTableContent()
{
    $('.articleTableContent').load('articleController.php',function(){
        $('.entity').append("<td><button class='view noborder'>view</button></td>");
        $('.entity').append("<td><button class='edit noborder'>edit</button></td>")
        $('.entity').append("<td><button class='delete noborder'>delete</button></td>")
        $('.articleTableContent .view').click(function(){
            var idarticle = $(this).parent().parent().attr('content');
            $.post('articleController.php','cmd=gethtml&idarticle='+idarticle,function(data){
                $('.content').html(data);
            })
        });
        $('.articleTableContent .delete').click(function(){
            var idarticle = $(this).parent().parent().attr('content');
            $.post('articleController.php',"cmd=delete&idarticle="+idarticle,loadArticleTableContent);
        })
        $('.articleTableContent .edit').click(function(){
            var idarticle = $(this).parent().parent().attr('content');
            var markdown = "";
            var html = "";
            var title = "";
            global_idarticle = idarticle;
            $.post('articleController.php','cmd=gettitle&idarticle='+idarticle,function(data){
                title = data;
                $('.editorArticleTitle').val(title);
            })
            $.post('articleController.php','cmd=getmarkdown&idarticle='+idarticle,function(data){
                markdown = data;
                $('.editorTextArea').val(markdown);
            })
            $.post('articleController.php','cmd=gethtml&idarticle='+idarticle,function(data){
                html = data;
                $('.editorPreview').html(html);
            })
            $('.content').load('editor2.html',function(){
                $('.editorTextArea').val(markdown);
                $('.editorPreview').html(html);
                $('.editorArticleTitle').val(title);
                $('.articleCommand .save').click(function(){
                    markdown = $('.editorTextArea').val();
                    html = markdownToHTML(markdown);
                    title = $('.editorArticleTitle').val();
                    updateArticle(idarticle,title,markdown,html);
                })
                $('.articleCommand .saveAndExit').click(function(){
                    markdown = $('.editorTextArea').val();
                    html = markdownToHTML(markdown);
                    title = $('.editorArticleTitle').val();
                    updateArticle(idarticle,title,markdown,html);
                    menuArticles();
                })
                $('.articleCommand .cancel').click(function(){
                    menuArticles();
                })
            });
        })
    });
}
