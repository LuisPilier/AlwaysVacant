import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EditvacantComponent } from './editvacant.component';

describe('EditvacantComponent', () => {
  let component: EditvacantComponent;
  let fixture: ComponentFixture<EditvacantComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EditvacantComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(EditvacantComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
