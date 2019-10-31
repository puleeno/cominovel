import { combineEpics, ofType } from "redux-observable";
import {  delay, mapTo } from "rxjs/operators";

const PING = "PING";
const PONG = "PONG";

const pingEpic = (action$: any) => action$.pipe(
  ofType(PING),
  delay(1000),
  mapTo({ type: PONG }),
);

export default combineEpics(pingEpic);
