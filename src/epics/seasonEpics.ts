import { Action, AnyAction } from "redux";
import { Epic, ofType } from "redux-observable";
import { from } from "rxjs";
import { ajax } from "rxjs/ajax";
import { map, mergeMap } from "rxjs/operators";
import { fetchSeasons, fetchSeasonsFullFilled } from "../actions";

export const getCominovelSeasonsViaAjax:
  Epic<Action<any>, Action<any>, void> = (action$) => action$.pipe(
    ofType(fetchSeasons),
    mergeMap(
      (action: AnyAction) => from(
        ajax.getJSON(`${window.Cominovel.endpoints.seasons}?post_id=${action.payload}`),
      ).pipe(
        map((response: any) => fetchSeasonsFullFilled(response)),
      ),
    ),
  );
