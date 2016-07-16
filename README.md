secretly modify
====

This script is a WordPress plugin. You will be able to update the article that does not involve an update of the feed. This is useful when you add a minor correction to the article.

## Hook

Add the "secretly_modify" action hook. It will be executed when option is enabled. This hook is run at the same time as the "wp_insert_post_data" filter.

```
add_action( 'secretly_modify', function () {
    //Please write your code.
});
```
