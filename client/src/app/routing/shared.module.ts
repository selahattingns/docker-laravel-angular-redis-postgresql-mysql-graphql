import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from '../routes/layouts/header/header.component'; // Kullanılacak bileşeni ekleyin
import { FooterComponent } from '../routes/layouts/footer/footer.component'; // Kullanılacak bileşeni ekleyin

@NgModule({
    declarations: [
        HeaderComponent,
        FooterComponent
    ],
    imports: [CommonModule],
    exports: [
        HeaderComponent,
        FooterComponent
    ],
})
export class SharedModule { }
