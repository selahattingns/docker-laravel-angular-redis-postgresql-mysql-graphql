Special Command to Create Factory;

    php artisan create:factory --user=10 --post=5 --comment=2
    
    
-
For example graphql usage, make a post request to http://127.0.0.1:8000/graphql link


    {
      posts(user_id: 1){
        id,
        title,
        comments {
          id,
          user_id
          post_id
          content
        },
        tags{
          name
        }
      },
      
      post(id: 2){
        comments{
          content
        }
      }
      
      comments(user_id:1, post_id: 2){
        content
      },
      
      tags{
        name
      },
      
      tag(id: 2){
        name,
        posts {
          title
        }
      }
    }
