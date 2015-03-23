(function($) {

    window.postId = function($this) {
        return $this.parents('.post-options').data('post-id');
    }

    window.changeCount = function(element, amount) {
        if (typeof my_id !== 'undefined') {
            if (my_id !== user_id) {
                return;
            }
        }
        var count = parseInt($(element).text()) + amount;
        $(element).text(count);
    }

    window.decreaseCount = function(element) {
        changeCount(element, -1);
    }

    window.increaseCount = function(element) {
        changeCount(element, 1);
    }

    window.toggleRepost = function($this) {
        if ( $this.hasClass('reposted') ) {
            var count = parseInt($this.text()) - 1;
            $this.removeClass('reposted');
            decreaseCount('.post-count');
        } else {
            var count = parseInt($this.text()) + 1;
            $this.addClass('reposted');
            increaseCount('.post-count');
        }
        $this.html(' ' + count);
    }

    window.toggleFavorite = function($this) {
        if ( $this.hasClass('favorited') ) {
            var count = parseInt($this.text()) - 1;
            $this.removeClass('favorited');
            decreaseCount('.favorite-count');
        } else {
            var count = parseInt($this.text()) + 1;
            $this.addClass('favorited');
            increaseCount('.favorite-count');
        }
        $this.html(' ' + count);
    }

    window.colorInvalid = function(post) {
        var newPost = [];
        if (post.length > 140) {
            newPost.push(post.substring(0, 140));
            newPost.push('<span class="invalid">' + post.substring(140, post.length) + '</span>');
            return newPost.join('');
        }
        return post;
    }

    window.colorMentions = function(post) {
        var newPost = [];
        post.split(' ').forEach(function(word) {
            if (word.charAt(0) === '@') {
                word = "<span class=\"primary-blue\">" + word + "</span>";
            }
            newPost.push(word);
        });
        return newPost.join(' ');
    }

    window.setEndOfContenteditable = function(contentEditableElement)
    {
        var range,selection;
        if(document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
        {
            range = document.createRange();//Create a range (a range is a like the selection but invisible)
            range.selectNodeContents(contentEditableElement);//Select the entire contents of the element with the range
            range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
            selection = window.getSelection();//get the selection object (allows you to change selection)
            selection.removeAllRanges();//remove any selections already made
            selection.addRange(range);//make the range you have just created the visible selection
        }
        else if(document.selection)//IE 8 and lower
        {
            range = document.body.createTextRange();//Create a range (a range is a like the selection but invisible)
            range.moveToElementText(contentEditableElement);//Select the entire contents of the element with the range
            range.collapse(false);//collapse the range to the end point. false means collapse to end rather than the start
            range.select();//Select the range (make it the visible selection
        }
    }

})(jQuery);