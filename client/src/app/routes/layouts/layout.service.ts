import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class LayoutService {
    private layoutDataSubject = new BehaviorSubject<any>(null);
    layoutData$ = this.layoutDataSubject.asObservable();

    /**
     *
     * @param data
     */
    setLayoutData(data: any) {
        this.layoutDataSubject.next(data);
    }
}
