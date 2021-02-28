import { Component, OnInit, ElementRef } from '@angular/core';
import { Location} from '@angular/common';


@Component({
  selector: 'app-headeradmin',
  templateUrl: './headeradmin.component.html',
  styleUrls: ['./headeradmin.component.css']
})
export class HeaderadminComponent implements OnInit {
  private toggleButton: any;
  private sidebarVisible: boolean;

  model: any;
  constructor(public location: Location, private element : ElementRef) 
  {
    this.sidebarVisible = false;
  }


  getsession(){
    this.model  = JSON.stringify (localStorage.getItem('Usuario'));
  }

  

  ngOnInit() {
    this.getsession();
    const navbar: HTMLElement = this.element.nativeElement;
    this.toggleButton = navbar.getElementsByClassName('navbar-toggler')[0];
  }
  
  logout(){
      localStorage.clear();
      document.location.href = (`http://localhost:4200/homepage`)
  }

  

  sidebarOpen() {
    const toggleButton = this.toggleButton;
    const html = document.getElementsByTagName('html')[0];
    // console.log(html);
    // console.log(toggleButton, 'toggle');

    setTimeout(function(){
        toggleButton.classList.add('toggled');
    }, 500);
    html.classList.add('nav-open');

    this.sidebarVisible = true;
};
sidebarClose() {
    const html = document.getElementsByTagName('html')[0];
    // console.log(html);
    this.toggleButton.classList.remove('toggled');
    this.sidebarVisible = false;
    html.classList.remove('nav-open');
};
sidebarToggle() {
    // const toggleButton = this.toggleButton;
    // const body = document.getElementsByTagName('body')[0];
    if (this.sidebarVisible === false) {
        this.sidebarOpen();
    } else {
        this.sidebarClose();
    }
};
isHome() {
  var titlee = this.location.prepareExternalUrl(this.location.path());
  if(titlee.charAt(0) === '#'){
      titlee = titlee.slice( 1 );
  }
    if( titlee === '/home' ) {
        return true;
    }
    else {
        return false;
    }
}
isDocumentation() {
  var titlee = this.location.prepareExternalUrl(this.location.path());
  if(titlee.charAt(0) === '#'){
      titlee = titlee.slice( 1 );
  }
    if( titlee === '/documentation' ) {
        return true;
    }
    else {
        return false;
    }
}
}
