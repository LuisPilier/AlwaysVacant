import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EditjobComponent } from './editjob.component';

describe('EditjobComponent', () => {
  let component: EditjobComponent;
  let fixture: ComponentFixture<EditjobComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EditjobComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(EditjobComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
