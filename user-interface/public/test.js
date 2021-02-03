// let segments = (a, b, r, per) => {
// 	let segments = [];
// 	let x = a;

//     switch (per) {
//         case "minut":
//             while (x < b) {
//                 segments.push({
//                     mls: x,
//                     dateString: new Date(x).toDateString(),
//                 });
//                 x = x + r;
//             };
//             return segments;
//         case "hour":
//             while (x < b) {
//                 segments.push({
//                     mls: x,
//                     dateString: new Date(x).toDateString(),
//                 });
//                 x = x + r;
//             };
//             return segments;

//         case "day":
//             while (x < b) {
//                 segments.push({
//                     mls: x,
//                     dateString: new Date(x).toDateString(),
//                 });
//                 x = x + r;
//             };
//             return segments;

//         case "week":
//             while (x < b) {
//                 segments.push({
//                     mls: x,
//                     dateString: new Date(x).toDateString(),
//                 });
//                 x = x + r;
//             };
//             return segments;

//         case "month":
//             while (x < b) {
//                 segments.push({
//                     mls: x,
//                     dateString: new Date(x).toDateString(),
//                 });
//                 x = x + r;
//             };
//             return segments;

//         case "year":
//             while (x < b) {
//                 segments.push({
//                     mls: x,
//                     dateString: new Date(x).toDateString(),
//                 });
//                 x = x + r;
//             };
//             return segments;
// };

// let per = (from, to) => {
// 	let h = 1000 * 60 * 60,
// 		d = h * 24,
// 		m = d * 30;

// 	a = new Date(to);
// 	b = new Date(from);

// 	let diff = Math.abs(a - b);

// 	//  'hour'
// 	//  'dayOfWeek'
// 	//  'week'
// 	//  'dayOfMonth'
// 	//  'month'
// 	//  'year'
// 	//  'dayOfYear'

// 	if (diff <= h) {
// 		// per minut
// 		return "minut";
// 	} else if (h < diff && diff <= d * 2) {
// 		// per hour
// 		return "hour";
// 	} else if (d * 2 < diff && diff <= m) {
// 		// per day, dayOfMonth
// 		return "dayOfMonth";
// 	} else if (m < diff && diff <= 6 * m) {
// 		// per week, week of the year 0-53
// 		return "week";
// 	} else {
// 		// per month
// 		return "month";
// 	}
// };

// per("01-25-2020", "01-26-2020");
// let x = per("2021-01-23T06:23", "2020-03-07T06:25");

// console.log(x);

// let d = new Date("01-26-2020");
// let da = new Date("2021-01-07T06:23");
// let db = new Date("2021-02-27T13:25");
// console.log(Date.parse("01-26-2020"), new Date(1), d.toDateString());
// console.log(segments(Date.parse("01-13-2020"), Date.parse("01-26-2020"), 1000 * 60 * 60 * 24));
