$(function() {

    var $modal = $('#reply');
    var $modalBody = $('.modal-body');
    var $modalTitle = $('.modal-title');
    var $modalContent = $modalBody.children('div:first-child');
    var $modalPostBox = $('#modal-reply-box');
    var $modalCount = $('.modal-count-down');
    var $modalSubmit = $('.modal-submit-post');

    var $postToUser = $('.tweet-to');
    var $submitPost = $('.submit-post');
    var $deletePost = $('.delete-post');

    var $reply = $('.fa-reply');
    var $repost = $('.fa-retweet');
    var $favorite = $('.fa-star');

    var $contentEditable = $('div[contenteditable]');
    var $postBox = $('.post-editable, #modal-reply-box');
    var $follow = $('.follow-options');

    $repost.click(function() {
        var $this = $(this);
        var url = $this.hasClass('reposted') ?
            '/repost/destroy' :
            '/repost/store';

        $.post(url, { '_token': csrf_token, 'post_id': postId($this) },
            function() { toggleRepost($this); }
        );
    });

    $reply.click(function() {
        var post = $(this).parents('.post');
        var text = post.find('.post-content').text();
        var html = post.html();
        var postId = post.find('.post-options').data('post-id');
        $modalTitle.text("Reply");
        $modalBody.show();
        $modalContent.data('post-id', postId) .html(html);
        $modalBody.find('.post-options').remove();
    });

    $favorite.click(function() {
        var $this = $(this);
        var url = $this.hasClass('favorited') ?
            '/post/unfavorite' :
            '/post/favorite';

        $.post(url, { '_token': csrf_token, 'post_id': postId($this) },
            function() { toggleFavorite($this); }
        );
    });

    $deletePost.click(function() {
        var $this = $(this);
        $.post("/post/destroy",
            { '_token': csrf_token, 'post_id': postId($this) },
            function() {
                $this.parents('.post').slideUp(function() {
                    $(this).remove();
                });
                decreaseCount('.post-count');
            }
        );
    });

    $postToUser.click(function() {
        var user = $(this).text().split('@')[1];
        $modalTitle.text($(this).find('a').text());
        $modalBody.hide();
        $modalPostBox.text('@' + user + '&nbsp;');
        updateEditable($modalPostBox);
    });

    $modalPostBox.change(function() {
        decreaseCount($modalCount);
    });

    $modalSubmit.click(function() {
        var $this = $(this);
        var post = $modalPostBox.text();
        var postId = $modalContent.data('post-id');
        var url = typeof postId !== 'undefined' ? '/post/reply' : '/post/create';
        $.post(url,
            { '_token': csrf_token, 'post': post, 'post_id': postId },
            function() {
                $modal.modal('hide');
            }
        );
    });

    $follow.on('click', 'button.click-unfollow, button.click-follow',
        function() {
            var $this = $(this);
            var url = $(this).hasClass('click-follow') ?
                '/subscribe/follow' :
                '/subscribe/unfollow';

            $.post(url, {'_token': csrf_token, 'follow_id': $this.data('user-id')},
                function (success) {
                    if (url.indexOf('unfollow') > -1) {
                        $this.addClass('click-follow btn-default')
                            .removeClass('click-unfollow btn-danger');
                        $this.html('<i class="fa fa-user-plus"></i> Follow');
                    } else {
                        $this.removeClass('click-follow btn-default')
                            .addClass('click-unfollow btn-danger');
                        $this.html('<i class="fa fa-user-times"></i> Unfollow');
                    }
                }
            );
        }
    );

    $contentEditable.keydown(function(e) {
        if (e.keyCode === 13) {
            newPost();
            return false;
        }
    });

    $submitPost.on('click', function() {
        newPost();
    });

    $postBox.on('keydown change', function() {
        updateEditable($(this));
        setTimeout(updateEditable.bind(null, $(this)), 100);
    });

});

