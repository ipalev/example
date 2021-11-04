"use strict";

export default class ItsUtils {

    static Declension(number, one, two, five) {
        number = Math.abs(number);
        number %= 100;
        if (number >= 5 && number <= 20) {
            return five;
        }
        number %= 10;
        if (number === 1) {
            return one;
        }
        if (number >= 2 && number <= 4) {
            return two;
        }
        return five;
    }

    static replaceArrays(replaceString, find, replace) {
        let regex;
        find.forEach(function(item, i){
            regex = new RegExp(item, "g");
            replaceString = replaceString.replace(regex, replace[i]);
        });
        return replaceString;
    }

    static debounce(f, ms) {
        let timer = null;

        return function (...args) {
            const onComplete = () => {
                f.apply(this, args);
                timer = null;
            }

            if (timer) {
                clearTimeout(timer);
            }

            timer = setTimeout(onComplete, ms);
        };
    }

}