import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import{ ApisService } from 'src/app/services/apis.service';
import {LoginI} from 'src/app/models/login.interface';
import {ResponseI} from 'src/app/models/response.interface';
import{Router} from '@angular/router';
@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.component.html',
  styleUrls: ['./homepage.component.css'],
  providers: [ApisService]
})
export class HomepageComponent implements OnInit {

loginForm = new FormGroup({
Usuario : new FormControl('',Validators.required),
Contrasena : new FormControl('',Validators.required),
});
  

  constructor(private api: ApisService, private router:Router) { }


  errorMessage:any = "";
  errorStatus:boolean = false;
  ngOnInit(): void {
    this.ValidarLocalStorage();
  }

  ValidarLocalStorage(){
    if(localStorage.getItem('Token')){
    document.location.href = (`http://localhost:4200/adminpage`);
    }
  }
  

  onlogin(form:LoginI){
    this.api.loginByUser(form).subscribe(data =>{
      let dataResponse:ResponseI = data;
      console.log(data);
      if(dataResponse.status == "ok"){
        localStorage.setItem("Token", dataResponse.result.Token);
        document.location.href = (`http://localhost:4200/adminpage`);
      }else{
        this.errorStatus = true;
        this.errorMessage = dataResponse.result.error_msg;
      }
    })
  }
 

}
