import 'core-js/modules/es.object.set-prototype-of';
import 'core-js/modules/es.function.bind';
import { Controller } from 'stimulus';

export default class extends Controller {
    openModal(event) {
        console.log(event);
    }
}
