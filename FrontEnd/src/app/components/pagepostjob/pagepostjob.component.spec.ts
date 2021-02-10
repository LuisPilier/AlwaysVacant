import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PagepostjobComponent } from './pagepostjob.component';

describe('PagepostjobComponent', () => {
  let component: PagepostjobComponent;
  let fixture: ComponentFixture<PagepostjobComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PagepostjobComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(PagepostjobComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
