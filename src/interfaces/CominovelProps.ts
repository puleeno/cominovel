import { Action } from "redux";
import { ITermType } from "./WordPressProps";

export interface IEndpoints {
    wpv2: string;
    fetchComic: string;
    seasons: string;
}

export interface ICominovelProps {
    currentID: number;
    endpoints: IEndpoints;
    languages: any;
    messages: any;
}

export interface ICominovelData {
    ID: number;
    adult: string;
    alternative_name: string;
    author: string;
    badge: string;
    chapters: any;
    parent: number;
    post_content: string;
    post_excerpt: string;
    post_modified: any;
    post_name: string;
    post_parent: number;
    post_status: string;
    post_title: string;
    post_type: string;
    season: string;
    short_description: string;
    rating_system: string;
    cmn_artist_terms: ITermType[];
    cmn_author_terms: ITermType[];
    cmn_country_terms: ITermType[];
    cmn_status_terms: ITermType[];
    genre_terms: ITermType[];
    cmn_release_terms: ITermType[];
}

export interface ISeason {
    meta_id: number;
    meta_key: string;
    meta_value: string;
    post_id: number;
}

export interface ITaxonomyAction extends Action {
    type: string;
    taxonomy: string;
    keyword?: string | null;
    payload: any;
}
