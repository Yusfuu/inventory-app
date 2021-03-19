let arr = ['a', 'a', 'a', 'b', 'b', 'c']
let obj = {};
arr.forEach(e => obj[e] = (obj[e] || 0) + 1);

