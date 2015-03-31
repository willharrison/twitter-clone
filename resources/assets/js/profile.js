$(function() {

    var $alert = $('.alert');
    var $modal = $('#reply');
    var $modalBody = $modal.find('.modal-body');
    var $modalTitle = $modal.find('.modal-title');
    var $modalContent = $modalBody.children('div:first-child');
    var $modalPostBox = $modal.find('#modal-reply-box');
    var $modalCount = $modal.find('.modal-count-down');
    var $modalSubmit = $modal.find('.modal-submit-post');

    var $postToUser = $('.tweet-to');
    var $submitPost = $('.submit-post');
    var $deletePost = $('.delete-post');

    var $reply = $('.fa-reply');
    var $repost = $('.fa-retweet');
    var $favorite = $('.fa-star');
    var $deleteAlert = $('.fa-trash-o');

    var $contentEditable = $('div[contenteditable]');
    var $postBox = $('.post-editable, #modal-reply-box');
    var $follow = $('.follow-options');

    $postToUser.click(function() {
        var user = $(this).text().split('@')[1];
        $modalTitle.text($(this).find('a').text());
        $modalBody.hide();
        $modalPostBox.text('@' + user + '&nbsp;');
        updateEditable($modalPostBox);
    });

    $reply.click(function() {
        var post = $(this).parents('.post');
        var text = post.find('.post-content').text();
        var html = post.html();
        var postId = post.find('.post-options').data('post-id');
        $modalTitle.text("Reply");
        $modalContent.data('post-id', postId) .html(html);
        $modalBody.find('.post-options').remove().show();
    });

    $repost.click(function() {
        var $this = $(this);
        var url = $this.hasClass('reposted') ?
            '/repost/destroy' :
            '/repost/store';

        $.post(url, { '_token': csrf_token, 'post_id': postId($this) },
            function() { toggleRepost($this); }
        );
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
            function(success) {
                if (typeof my_id !== 'undefined') {
                    if (my_id === user_id) {
                        var clone = $('.cloneable-post').clone(true, true);
                        clone.removeClass('cloneable-post').addClass('post');
                        clone.find('.post-content').html(success.data.post);
                        clone.find('.post-options').data('post-id', success.data.id);
                        clone.find('.created-at').html(success.data.created);
                        clone.find('.view-post').attr('href', my_name + '/status/' + success.data.id);
                        $('.post-create').after(clone.addClass('new-post'));
                        $('.new-post').hide().slideDown().removeClass('new-post');
                        increaseCount('.post-count');
                    }
                }
                $this.parents('.modal-footer').find('#modal-reply-box').html('');
                $this.parent('.modal-footer').children('.create-post-count-down').html('140');
                $modal.modal('hide');
                $alert.show().animate({'margin-top': '-52px'});
                setTimeout(function() {
                    $alert.animate({'margin-top': '-500px'}, function() {
                        $(this).hide();
                    });
                }, 2000);
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
                            .removeClass('click-unfollow btn-danger')
                            .html('<i class="fa fa-user-plus"></i> Follow');
                    } else {
                        $this.removeClass('click-follow btn-default')
                            .addClass('click-unfollow btn-danger')
                            .html('<i class="fa fa-user-times"></i> Unfollow');
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

    $deleteAlert.on('click', function() {
        var $this = $(this);
        $(this).parents('.post').slideUp();
        var alertId = $(this).parents('.post').data('alert-id');
        $.post("/alert/read",
            { '_token': csrf_token, 'alert_id': alertId },
            function(success) {
                console.log(success);
                $this.parents('.post').slideUp(function() {
                    $(this).remove();
                    decreaseCount('.notification-count');
                });
            }
        );
    });

});

