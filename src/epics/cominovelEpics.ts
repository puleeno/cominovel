
import { Action, AnyAction } from "redux";
import { Epic, ofType } from "redux-observable";
import { from } from "rxjs";
import { ajax } from "rxjs/ajax";
import { map, mergeMap } from "rxjs/operators";
import { fetchCominovelData, setAppStatus } from "../actions";
import { FETCH_COMINOVEL } from "../actions/types";
import store from "../store";

const fetchCominovelEpic: Epic<Action<any>, Action<any>, void> = (action$) => action$.pipe(
    ofType(FETCH_COMINOVEL),
    mergeMap(
        (action: AnyAction) => from(
            ajax.getJSON(
              window.Cominovel.endpoints.fetchComic.replace("<post_id>", action.payload),
            ),
        ).pipe(
            map((response: any) => {
                store.dispatch(setAppStatus(true));
                return fetchCominovelData(response);
            }),
        ),
    ),
);

export default fetchCominovelEpic;
