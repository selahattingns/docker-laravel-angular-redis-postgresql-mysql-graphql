import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import {CommentService} from "./comment.service";
import {ToastrService} from "ngx-toastr";
import {Router} from "@angular/router";

@Component({
  selector: 'app-comment-list',
  templateUrl: './comment-list.component.html',
  styleUrls: ['./comment-list.component.scss']
})
export class CommentListComponent {
  newContent = "";
  filterContent = "";
  comments: any = [];
  post: any = {};
  postId: string = "";

  constructor(private route: ActivatedRoute, private commentService: CommentService, private router:Router, private toastr: ToastrService) {}

  ngOnInit(): void {
    this.route.params.subscribe(params => {
        this.postId = params["post_id"];
        this.getCommentList();
    });
  }

  /**
   *
   */
  getCommentList(){
    this.commentService.getCommentList(this.postId, this.filterContent).subscribe(
        (response) => {
            this.post = response.post;
            this.comments = response.comments;
        }
    );
  }

    /**
     *
     * @param comment
     */
  deleteComment(comment: any){
    this.commentService.deleteComment(comment.id).subscribe(
        (response) => {
          this.toastr.success('success', 'comment deleted.');
          this.getCommentList();
        }
    );
  }

  /**
   *
   */
  storeComment(){
    this.commentService.storeComment(parseInt(this.postId), this.newContent).subscribe(
        (response) => {
          this.toastr.success('success', 'comment added.');
          this.getCommentList();
          this.newContent = "";
        }
    );
  }

    /**
     *
     * @param comment
     */
  updateComment(comment: any){
    this.commentService.updateComment(comment.id, comment.content).subscribe(
        (response) => {
          this.toastr.success('success', 'comment updated.');
        }
    );
  }

    /**
     *
     */
  goToBack(){
      this.router.navigate(['pages/post-list/']);
  }
}
