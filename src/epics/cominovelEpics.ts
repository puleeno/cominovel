
import { Action, AnyAction } from "redux";
import { Epic, ofType } from "redux-observable";
import { from } from "rxjs";
import { ajax } from "rxjs/ajax";
import { map, mergeMap } from "rxjs/operators";
import { fetchCominovelData } from "../actions";
import { FETCH_COMINOVEL } from "../actions/types";

const fetchCominovelEpic: Epic<Action<any>, Action<any>, void> = (action$, store) => action$.pipe(
    ofType(FETCH_COMINOVEL),
    mergeMap(
        (action: AnyAction) => from(
            ajax.getJSON(`http://loveofboys.io/wp-json/cominovel/v1/comic/${action.payload}`),
        ).pipe(
            map((response: any) => fetchCominovelData(response)),
        ),
    ),
);

export default fetchCominovelEpic;
