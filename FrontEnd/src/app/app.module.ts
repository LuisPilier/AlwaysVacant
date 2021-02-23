import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';


import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { HomepageComponent } from './components/homepage/homepage.component';
import { AdminpageComponent } from './components/adminpage/adminpage.component';
import { NoopAnimationsModule } from '@angular/platform-browser/animations';
import { PagepostjobComponent } from './components/pagepostjob/pagepostjob.component';
import { SidebarComponent } from './components/sidebar/sidebar.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { EditjobComponent } from './components/editjob/editjob.component';
import { CreatecategoryComponent } from './components/createcategory/createcategory.component';
import { NumberofjobComponent } from './components/numberofjob/numberofjob.component';
import { HomepagejobsComponent } from './components/homepagejobs/homepagejobs.component';
<<<<<<< Updated upstream
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
=======
import { JobsdetailsComponent } from './components/jobsdetails/jobsdetails.component';
>>>>>>> Stashed changes



import { HttpClientModule, HttpClient } from '@angular/common/http';
@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    HomepageComponent,
    AdminpageComponent,
    PagepostjobComponent,
    SidebarComponent,
    EditjobComponent,
    CreatecategoryComponent,
    NumberofjobComponent,
    HomepagejobsComponent,
    JobsdetailsComponent,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NoopAnimationsModule,
    FontAwesomeModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
