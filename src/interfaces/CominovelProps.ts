import { Action } from "redux";
import { ITermType } from "./WordPressProps";

export interface IEndpoint {
    url: string;
}

export interface ICominovelProps {
    currentID: number;
    endpoints: IEndpoint[];
    languages: any;
    messages: any;
}

export interface ICominovelData {
    ID: number;
    alternative_name: string;
    audult: string;
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
    cm_artist_terms: ITermType[];
    cm_author_terms: ITermType[];
    cm_country_terms: ITermType[];
    cm_status_terms: ITermType[];
    genre_terms: ITermType[];
    cm_release_terms: ITermType[];
}

export interface ISeason {
    id: number;
    name: string;
}

export interface ITaxonomyAction extends Action {
    type: string;
    taxonomy: string;
    keyword?: string | null;
    payload: any;
}
