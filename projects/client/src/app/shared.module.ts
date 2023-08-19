import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './routes/layouts/header/header.component'; // Kullanılacak bileşeni ekleyin
import { FooterComponent } from './routes/layouts/footer/footer.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";

@NgModule({
    declarations: [
        HeaderComponent,
        FooterComponent
    ],
    imports: [
        CommonModule,
        ReactiveFormsModule,
        FormsModule
    ],
    exports: [
        HeaderComponent,
        FooterComponent
    ],
})
export class SharedModule { }
