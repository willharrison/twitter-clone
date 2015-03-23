$(function() {

    function updateEditable($this) {
        var elem = document.getElementById('modal-reply-box');
        if ($this.hasClass('post-editable')) {
            elem = document.getElementsByClassName('post-editable')[0];
        }
        var newHtml = colorMentions(colorInvalid($this.text(), elem));
        $this.html(newHtml);
        setEndOfContenteditable(elem);
        var newValue = 140 - $this.text().length;
        if (newValue < 0) {
            if ($this.hasClass('post-editable')) {
                $('.create-post-count-down').css({color: '#d40d12'}).text(newValue);
                $('.submit-post').prop('disabled', true);
            } else {
                $('.modal-count-down').css({color: '#d40d12'}).text(newValue);
                $('.modal-submit-post').prop('disabled', true);
            }
        } else {
            if ($this.hasClass('post-editable')) {
                $('.create-post-count-down').css({color: '#333'}).text(newValue);
                $('.submit-post').prop('disabled', false);
            } else {
                $('.modal-count-down').css({color: '#333'}).text(newValue);
                $('.modal-submit-post').prop('disabled', false);
            }
        }
    }

    $('.post-editable').on('keyup', function() {
        updateEditable($(this));
        setTimeout(updateEditable.bind(null, $(this)), 100);
    });

    $('.post-editable').on('change', function() {
        updateEditable($(this));
        setTimeout(updateEditable.bind(null, $(this)), 100);
    });

    $('#modal-reply-box').on('keyup', function() {
        updateEditable($(this));
        setTimeout(updateEditable.bind(null, $(this)), 100);
    });

    $('#modal-reply-box').on('change', function() {
        updateEditable($(this));
        setTimeout(updateEditable.bind(null, $(this)), 100);
    });

    var newPost = function() {
        var $this = $('.submit-post');
        var post = $this.parents('.post-create').find('.post-editable').text();
        $.post("/post/create",
            { '_token': csrf_token, 'post': post },
            function(success) {
                $this.blur();
                $this.parents('.post-create').find('.post-editable').html('');
                $this.parent('div').children('.create-post-count-down').html('140');
                var clone = $('.cloneable-post').clone(true, true);
                clone.removeClass('cloneable-post').addClass('post');
                clone.find('.post-content').html(success.data.post);
                clone.find('.post-options').data('post-id', success.data.id);
                clone.find('.created-at').html(success.data.created);
                $this.parents('.posts').find('.post-create').after(clone.addClass('new-post'));
                $('.new-post').hide().slideDown().removeClass('new-post');
                increaseCount('.post-count');
            }
        );
    }

    $('div[contenteditable]').keydown(function(e) {
        if (e.keyCode === 13) {
            newPost();
            return false;
        }
    });

    $('.submit-post').on('click', function() {
        newPost();
    });

    $('#modal-reply-box').change(function() {
        var footer = $(this).parents('.modal-footer');
        var current = parseInt(footer.find('.modal-count-down').text());
        var newVal = current - $(this).val().length;
        footer.find('.modal-count-down').text(newVal);
    });

    $('.modal-submit-post').click(function() {
        var $this = $(this);
        var post = $this.parents('.modal-footer').find('#modal-reply-box').text();
        var postId = $('.modal-body').children('div:first-child') .data('post-id');
        $.post("/post/reply",
            { '_token': csrf_token, 'post': post, 'post_id': postId },
            function() {
                $('#reply').modal('hide');
            }
        );
    });

    $('.fa-reply').click(function() {
        var post = $(this).parents('.post');
        var text = post.find('.post-content').text();
        var html = post.html();
        var postId = post.find('.post-options').data('post-id');
        $('.modal-title').text("Reply");
        $('.modal-body').children('div:first-child')
            .data('post-id', postId)
            .html(html);
        $('.modal-body').find('.post-options').remove();
    });

    $('.delete-post').click(function() {
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

    $('.fa-retweet').click(function() {
        var $this = $(this);
        var url = $this.hasClass('reposted') ?
            '/repost/destroy' :
            '/repost/store';

        $.post(url, { '_token': csrf_token, 'post_id': postId($this) },
            function() { toggleRepost($this); }
        );
    });


    $('.fa-star').click(function() {
        var $this = $(this);
        url = $this.hasClass('favorited') ?
            '/post/unfavorite' :
            '/post/favorite';

        $.post(url, { '_token': csrf_token, 'post_id': postId($this) },
            function() { toggleFavorite($this); }
        );
    });

});

