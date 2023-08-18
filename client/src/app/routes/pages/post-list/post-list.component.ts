import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import {PostService} from "./post.service";
import {ToastrService} from "ngx-toastr";
import {Router} from "@angular/router";

@Component({
  selector: 'app-post-list',
  templateUrl: './post-list.component.html',
  styleUrls: ['./post-list.component.scss']
})
export class PostListComponent {
  isMyPost = false;
  newTitle = "";
  newContent = "";
  filterTitle = "";
  filterContent = "";
  filterTag = "";
  posts: any = [];

  constructor(private route: ActivatedRoute, private postService: PostService, private router:Router, private toastr: ToastrService) {}

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.isMyPost = params['filter'] == 'me';
      this.getPostList();
    });
  }

  /**
   *
   */
  getPostList(){
    this.postService.getPostList(this.isMyPost, this.filterTitle, this.filterContent, this.filterTag).subscribe(
        (response) => {
               this.posts = response;
             }
    );
  }

  /**
   *
   * @param post
   */
  deletePost(post: any){
    this.postService.deletePost(post.id).subscribe(
        (response) => {
          this.toastr.success('success', 'post deleted.');
          this.getPostList();
        }
    );
  }

  /**
   *
   */
  storePost(){
    this.postService.storePost(this.newTitle, this.newContent).subscribe(
        (response) => {
          this.toastr.success('success', 'post added.');
          this.getPostList();
          this.newTitle = "";
          this.newContent = "";
        }
    );
  }

  /**
   *
   * @param post
   */
  updatePost(post: any){
      this.postService.updatePost(post.id, post.title, post.content).subscribe(
          (response) => {
              this.toastr.success('success', 'post updated.');
          }
      );
  }

    /**
     *
     * @param postId
     */
  goToComment(postId: number){
      this.router.navigate(['pages/comment-list/' + postId]);
  }

    /**
     *
     * @param tagName
     */
  selectTag(tagName: string){
      this.filterTag = tagName;
      this.getPostList();
  }
}
