import { Component } from '@angular/core';
import {Router} from "@angular/router";
import {LayoutService} from "../layout.service";
import {ToastrService} from "ngx-toastr";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent {

  isLogout: boolean = true;

  /**
   *
   * @param router
   * @param layoutService
   * @param toastr
   */
  constructor(private router: Router, private layoutService: LayoutService, private toastr: ToastrService) {}

  ngOnInit(){
    this.layoutService.layoutData$.subscribe(data => {
      this.isLogout = data?.isLogout;
    });
    this.isLogout = localStorage.getItem('token') === null
  }

  /**
   *
   */
  homepage(){
    this.router.navigate(['pages/homepage']);
  }

  /**
   *
   */
  login(){
    this.router.navigate(['auth/login']);
  }

  /**
   *
   */
  register(){
    this.router.navigate(['auth/register']);
  }

  /**
   *
   */
  logout(){
    localStorage.removeItem('token');
    this.isLogout = true;
    this.toastr.success('Success', 'Logged out');
    this.router.navigate(['login']);
  }
}
