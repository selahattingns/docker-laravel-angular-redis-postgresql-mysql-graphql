import { Component } from '@angular/core';
import {Router} from "@angular/router";

@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.component.html',
  styleUrls: ['./homepage.component.scss']
})
export class HomepageComponent {

  /**
   *
   * @param router
   */
  constructor(private router: Router){}

  /**
   *
   * @param isMyPost
   */
  goToPostPage(isMyPost : boolean | null = null){
    this.router.navigate(['pages/post-list/'], { queryParams: {filter: isMyPost ? "me" : "all"} })
  }
}
