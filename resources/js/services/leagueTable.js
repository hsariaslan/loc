import { get, post } from './request';

export const getLeagueTable = () => get('http://localhost:8000/api/get-league-table')

export const calculateChampionshipPredictions = () => get('http://localhost:8000/api/calculate-championship-predictions')
