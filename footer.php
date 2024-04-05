<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer id="footer" class="footer <?php if (array_key_exists('archive',unserialize($this->___fields()))): ?>bg-white<?php elseif($this->is('archive')&&($this->options->colorBgPosts == 'defaultColor')): ?>bg-white<?php elseif($this->is('archive')&&($this->options->colorBgPosts == 'customColor')): ?>bg-grey<?php elseif($this->is('single')): ?>bg-white<?php endif; ?>">
    <div class="footer-social">
        <div class="footer-container clearfix">
            <div class="social-list">
            <?php if ($this->options->socialweibo): ?>
                <a class="social weibo" target="blank" href="<?php $this->options->socialweibo(); ?>">WEIBO</a>
            <?php endif; ?>
            <?php if ($this->options->socialzhihu): ?>
                <a class="social zhihu" target="blank" href="<?php $this->options->socialzhihu(); ?>">ZHIHU</a>
            <?php endif; ?>
                <a class="social rss" target="blank" href="<?php $this->options->siteUrl(); ?>feed/">RSS</a>
            <?php if ($this->options->socialgithub): ?>
                <a class="social github" target="blank" href="<?php $this->options->socialgithub(); ?>">GITHUB</a>
            <?php endif; ?>
            <?php if ($this->options->socialtwitter): ?>
                <a class="social twitter" target="blank" href="<?php $this->options->socialtwitter(); ?>">TWITTER</a>
            <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="footer-meta">
        <div class="footer-container">
            <div class="meta-item meta-copyright">
                <div class="meta-copyright-info">
                    <a href="<?php $this->options->siteUrl(); ?>" class="info-logo">
                        <?php if($this->options->footerLogoUrl): ?>
                        <img src="<?php $this->options->footerLogoUrl();?>" alt="<?php $this->options->title() ?>" />
                        <?php else : ?>
                        <?php $this->options->title() ?>
                        <?php endif; ?>
                    </a>
                    <div class="info-text">
			<p>Theme is <a href="https://github.com/chakhsu/pinghsu" target="blank">Pinghsu</a> by <a href="https://www.linpx.com/" target="_blank">Chakhsu</a></p>
                        <?php if ($this->options->ICPRecordNumber): ?>
                        <p><a href="https://beian.miit.gov.cn/" target="blank" ><?php $this->options->ICPRecordNumber(); ?></a></p>
                        <?php endif; ?>
                        <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a> <a href="https://cloudflare.com/" title="Powered by Cloudflare" target='_blank'><img style='display:inline-block;vertical-align:baseline' alt="Cloudflare" src="https://s3.lovejk.cc/pic/cloudflare.svg" width="50" height="16"></a></p>
                    </div>
                </div>
            </div>
            <div class="meta-item meta-posts">
                <h3 class="meta-title">RECENT POSTS</h3>
                <?php getRecentPosts($this,8); ?>
            </div>
            <div class="meta-item meta-tags">
                <h3 class="meta-title">HOT TAGS</h3>
                <?php getHotTags($this,20); ?>
        </div>
    </div>
</footer>

<?php if (($this->options->tableOfContents == 'able') && ($this->is('post'))): ?>
<div id="directory-content" class="directory-content">
    <nav class="toc js-toc"></nav>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/tocbot/4.25.0/tocbot.min.js"></script>
<script>
function addTocId() {
    var id = 1;
    var entryContent = document.querySelector('.post-content');
    var headings = entryContent.querySelectorAll('h1, h2, h3, h4, h5');

    headings.forEach(function(heading) {
        var hyphenated = 'anchor-' + id;
        heading.setAttribute('id', hyphenated);
        id++;
    });
}
addTocId();
</script>
<?php endif; ?>
<?php if(($this->is('single')) && ($this->allow('comment'))): ?>
<script>
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
        create : function (tag, attr) {
            var el = document.createElement(tag);
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
            return el;
        },
        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php echo $this->respondId(); ?>'),
                input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];
            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }
            input.setAttribute('value', coid);
            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }
            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';
            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }
            return false;
        },
        cancelReply : function () {
            var response = this.dom('<?php echo $this->respondId(); ?>'),
            holder = this.dom('comment-form-place-holder'),
            input = this.dom('comment-parent');
            if (null != input) {
                input.parentNode.removeChild(input);
            }
            if (null == holder) {
                return true;
            }
            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
<?php if(!$this->user->hasLogin()): ?>
function getCommentCookie(name){
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=document.cookie.match(reg))
        return unescape(decodeURI(arr[2]));
    else
        return null;
}
function addCommentInputValue(){
    document.getElementById('author').value = getCommentCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_author');
    document.getElementById('mail').value = getCommentCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_mail');
    document.getElementById('url').value = getCommentCookie('<?php echo md5($this->request->getUrlPrefix()); ?>__typecho_remember_url');
}
addCommentInputValue();
<?php endif; ?>
</script>
<?php endif; ?>
<?php $this->footer(); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/headroom/0.12.0/headroom.min.js"></script>
<?php if ($this->options->useHighline == 'able'): ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<?php endif; ?>
<?php if ($this->options->pjaxSet == 'able'): ?>
<script src="<?php $this->options->themeUrl('js/instantclick.min.js?v20140319'); ?>"></script>
<?php endif; ?>
<?php if ($this->options->fastClickSet == 'able'): ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<?php endif; ?>
<script>
<?php if (($this->options->tableOfContents == 'able') && ($this->is('post'))): ?>
var postDirectory = new Headroom(document.getElementById("directory-content"), {
    tolerance: 0,
    <?php if ($this->options->postshowthumb == 'able'): ?>
    offset : 280,<?php else: ?>
    offset : 90,<?php endif; ?>
    classes: {
        initial: "initial",
        pinned: "pinned",
        unpinned: "unpinned"
    }
});
postDirectory.init();
tocbot.init({
    tocSelector: '.toc',
    contentSelector: '.post-content',
    headingSelector: 'h1, h2, h3, h4, h5',
    collapseDepth: 2,
    scrollSmooth: true,
    scrollSmoothDuration: 600,
    scrollSmoothOffset: -80,
    headingsOffset: 80,
});
<?php endif; ?>
<?php if($this->is('post')): ?>
var postSharer = new Headroom(document.getElementById("post-bottom-bar"), {
    tolerance: 0,
    offset : 70,
    classes: {
        initial: "animated",
        pinned: "pinned",
        unpinned: "unpinned"
    }
});
postSharer.init();
<?php endif; ?>
var header = new Headroom(document.getElementById("header"), {
    tolerance: 0,
    offset : 70,
    classes: {
      initial: "animated",
      pinned: "slideDown",
      unpinned: "slideUp"
    }
});
header.init();
<?php if (($this->options->pjaxSet == 'disable') && ($this->options->useHighline == 'able') && ($this->is('post'))): ?>
hljs.initHighlightingOnLoad();
<?php endif; ?>
<?php if ($this->options->fastClickSet == 'able'): ?>
if ('addEventListener' in document) {
    document.addEventListener('DOMContentLoaded', function() {
        FastClick.attach(document.body);
    }, false);
}
<?php endif; ?>
</script>
<?php if ($this->options->useMathjax == 'able'): ?>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({
    showProcessingMessages: false,
    messageStyle: "none",
    extensions: ["tex2jax.js"],
    jax: ["input/TeX", "output/HTML-CSS"],
    tex2jax: {
        inlineMath: [ ['$','$'], ["\\(","\\)"] ],
        displayMath: [ ['$$','$$'], ["\\[","\\]"] ],
        skipTags: ['script', 'noscript', 'style', 'textarea', 'pre','code','a'],
        ignoreClass:"comment-content"
    },
    "HTML-CSS": {
        availableFonts: ["STIX","TeX"],
        showMathMenu: false
    }
});
MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.2/es5/tex-mml-chtml.min.js"></script>
<?php endif; ?>
<?php if($this->options->GoogleAnalytics): ?>
<?php $this->options->GoogleAnalytics(); ?>
<?php endif; ?>
<?php if ($this->options->pjaxSet == 'able'): ?>
<script data-no-instant>
InstantClick.on('change', function(isInitialLoad){
    <?php if ($this->options->useHighline == 'able'): ?>
    var blocks = document.querySelectorAll('pre code');
    for (var i = 0; i < blocks.length; i++) {
        hljs.highlightElement(blocks[i]);
    }
    <?php endif; ?>

    if (isInitialLoad === false) {
    <?php if($this->options->GoogleAnalytics): ?>
        if (typeof ga !== 'undefined') ga('send', 'pageview', location.pathname + location.search);
    <?php endif; ?>
    <?php if($this->options->useMathjax == 'able'): ?>
        if (typeof MathJax !== 'undefined'){MathJax.Hub.Queue(["Typeset",MathJax.Hub]);}
    <?php endif; ?>
    }
});
InstantClick.init('mousedown');
</script>
<?php endif; ?>
</body>
</html>
<?php if ($this->options->htmlCompress == 'able'): $html_source = ob_get_contents(); ob_clean(); print compressHtml($html_source); ob_end_flush(); endif; ?>