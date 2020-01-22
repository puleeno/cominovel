import { Action, AnyAction } from "redux";
import { Epic, ofType } from "redux-observable";
import { from } from "rxjs";
import { ajax, AjaxResponse } from "rxjs/ajax";
import { map, mergeMap } from "rxjs/operators";
import { fetchSeasonsFullFilled } from "../actions";
import { FETCH_SEASONS, UPDATE_SEASONS } from "../actions/types";

export const getCominovelSeasonsViaAjax:
  Epic<Action<any>, Action<any>, void> = (action$) => action$.pipe(
  ofType( FETCH_SEASONS ),
  mergeMap(
    (action: AnyAction) => from(
      ajax.getJSON(`${window.Cominovel.endpoints.seasons}?post_id=${action.payload}`),
    ).pipe(
      map((response: any) => fetchSeasonsFullFilled(response)),
    ),
  ),
);

export const updateCominovelSeasons: Epic<Action<any>, Action<any>, void> = (action$) => action$.pipe(
  ofType( UPDATE_SEASONS ),
  mergeMap(
    (action: AnyAction) => from(
      ajax({
        body: {
          post_id: action.payload.postId,
          seasons: action.payload.seasons,
        },
        headers: {
          "Content-Type": "application/json",
        },
        method: "PUT",
        url: window.Cominovel.endpoints.seasons,
      }),
    ).pipe(
      map((xhttpRequest: AjaxResponse) => fetchSeasonsFullFilled(xhttpRequest.response)),
    ),
  ),
);
