
/* import { Epic } from "redux-observable";
import { from } from "rxjs";
import { ajax } from "rxjs/ajax";
import { filter, map, mergeMap } from "rxjs/operators";
import { ActionType, isActionOf } from "typesafe-actions";
import { fetchCominovelData } from "../actions";
import * as actions from "../actions";
import { AppState } from "../reducers";

type Action = ActionType<typeof actions>;

const fetchCominovelEpic: Epic<Action, Action, AppState> = (action$, store) => action$.pipe(
    filter(isActionOf(actions.fetchCominovel)),
    mergeMap(
        (action: Action) => from(
            ajax.getJSON(`http://loveofboys.io/wp-json/cominovel/v1/comic/${action.payload}`),
        ).pipe(
            map((response: any) => fetchCominovelData(response)),
        ),
    ),
);

export default fetchCominovelEpic;
*/

export {};
