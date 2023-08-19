@if(isset($commentUser, $post))
    The person belonging to the "{{$commentUser["email"]}}" e-mail address wrote a comment on the post titled "{{$post["title"]}}".
@endif
