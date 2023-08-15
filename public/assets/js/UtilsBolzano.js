
const hasSignChange = (left, right, functionToCheck) => {
    return functionToCheck(left) * functionToCheck(right) < 0;
};

const findInterval = (functionToCheck) => {
    const interval = [];
    for (let x = -10; x <= 5000; x++) {
        if (hasSignChange(x, x + 1, functionToCheck)) {
            interval.push(x);
            interval.push(x + 1);
            return interval;
        }
    }
    throw new Error(
        "No se encuentra una raiz al buscar intervalos con bolzano"
    );
};

const myFunc = (x) => {
    return Math.sqrt(x + 1) - 4 * x + 2;
};

const interval = findInterval(myFunc);
console.log(`The interval with sign change is [${interval}]`);
